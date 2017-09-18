<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Organization;

class Message extends Model
{
    //
    public function organizations()
    {
        return $this->belongsToMany('App\Organization')->withTimestamps();
    }

    public static function getSentMessages()
    {
        return Message::where('sender', '=', Auth::user()->id)->where('messages.body','!=','notification')->orderBy('messages.id', 'ASC')->get();
    }

    public static function getInboxMessages()
    {

        $organization = DB::select('select organization_id from organization_user where user_id = ?', [Auth::user()->id]);
        $logged_organization = Organization::getLoggedOrganization();
//        dd($logged_organization);
        if ($logged_organization) {
            $messages = DB::table('message_organization')
                ->join('messages', 'messages.id', '=', 'message_organization.message_id')
                ->orderBy('messages.created_at', 'DESC')
                ->where('message_organization.organization_id', $logged_organization)
                ->where('messages.body','!=','notification')
                ->get();
        } else {
            $messages = DB::table('message_organization')
                ->join('messages', 'messages.id', '=', 'message_organization.message_id')
                ->orderBy('messages.created_at', 'DESC')
                ->get();
        }
        // dd($messages);
        return $messages;
        //return Message::where('sender', '=', Auth::user()->id )->get();
    }

    public static function getNgoNotifications()
    {
        $organization = DB::select('select organization_id from users where id = ?', [Auth::user()->id]);
        if ($organization[0]->organization_id) {
            $messages = DB::table('message_organization')
                ->join('messages', 'messages.id', '=', 'message_organization.message_id')
                ->orderBy('messages.created_at', 'DESC')
                ->where('message_organization.organization_id', $organization[0]->organization_id)
                ->where('messages.body', '=', 'notification')
                ->where('message_organization.last_viewed_by', '=', '0')
                ->get();
        }


        $notifications = array();
        foreach ($messages as $key => $message) {
            $notifications[$key] = $message;
            $notifications[$key]->created_at = Carbon::parse($message->created_at)->diffForHumans();
        }


        return $notifications;
        //return Message::where('sender', '=', Auth::user()->id )->get();
    }

    public static function getNgoMessages()
    {
        $organization = DB::select('select organization_id from users where id = ?', [Auth::user()->id]);
        if ($organization[0]->organization_id) {
            $messages = DB::table('message_organization')
                ->join('messages', 'messages.id', '=', 'message_organization.message_id')
                ->orderBy('messages.created_at', 'DESC')
                ->where('message_organization.organization_id', $organization[0]->organization_id)
                ->where('messages.url', '=', '')
                ->where('message_organization.last_viewed_by', '=', '0')
                ->get();
        }


        $msgs = array();

        foreach ($messages as $key => $message) {
            $msgs[$key] = $message;
            $msgs[$key]->created_at = Carbon::parse($message->created_at)->diffForHumans();
        }

        //dd($msgs);


        return $msgs;
        //return Message::where('sender', '=', Auth::user()->id )->get();
    }


    public static function getAllNotificationsOfNgo()
    {
        $organization = DB::select('select organization_id from users where id = ?', [Auth::user()->id]);
        //dd($organization);
        if ($organization[0]->organization_id) {
            $messages = DB::table('message_organization')
                ->join('messages', 'messages.id', '=', 'message_organization.message_id')
                ->orderBy('message_organization.created_at', 'DESC')
                ->where('message_organization.organization_id', $organization[0]->organization_id)
                ->where('messages.body', '=', 'notification')
                ->paginate(40);

        }
        //dd($messages);
        return $messages;
        //return Message::where('sender', '=', Auth::user()->id )->get();
    }

    public static function messageViewed($mid)
    {
        //dd(Auth::user()->organization()->get()[0]->id);
        DB::table('message_organization')
            ->where('message_id', $mid)
            ->where('organization_id', Auth::user()->organization()->get()[0]->id)
            ->update(array('last_viewed_by' => Auth::user()->id, 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()));
    }

    public static function getNotificationInfo($mid)
    {
        $organization = DB::select('select organization_id from users where id = ?', [Auth::user()->id]);
        $notification = DB::table('message_organization')
            ->join('messages', 'messages.id', '=', 'message_organization.message_id')
            ->orderBy('messages.created_at', 'ASC')
            ->where('message_organization.organization_id', $organization[0]->organization_id)
            ->where('messages.body', '=', 'notification')
            ->where('message_organization.message_id', '=', $mid)
            ->select('messages.*', 'message_organization.updated_at as last_viewed_on')
            ->get();

        return $notification;
    }


    public static function sendNotification($key, $subject, $url, $lid, $ids)
    {
        $message = new Message();
        $message->subject = ($subject == '') ? Message::generateSubject($key, $lid) : $subject;
        $message->sender = Auth::user()->id;
        $message->body = 'notification';
        $message->url = $url;
        $message->save();
        $message->organizations()->sync($ids);
    }

    public static function generateSubject($key, $lid)
    {
        $subject = '';
        $litigation = Litigation::findOrFail($lid);

        switch ($key) {
            case 'task_status':
                $subject = Auth::user()->organization()->get()[0]->name . ' has changed the <strong>' . $key . '</strong> on case id <strong>' . $litigation->case_id . '</strong>';
                break;
            case 'revoked':
                $subject = Auth::user()->organization()->get()[0]->name . ' has <strong>' . $key . '</strong> your access on case id <strong>' . $litigation->case_id . '</strong>';
                break;
            case 'granted':
                $subject = Auth::user()->organization()->get()[0]->name . ' has given you access on case id <strong>' . $litigation->case_id . '</strong>';
                break;

            default:
                $subject = Auth::user()->organization()->get()[0]->name . ' worked on case id <strong>' . $litigation->case_id . '</strong>';
        }
        return $subject;
    }


    public static function sendAssignmentEmail($lid, $added_nids)
    {
        $litigation = Litigation::findOrFail($lid);

        foreach ($added_nids as $oid) {
            $org = Organization::findOrFail($oid);
            //dd($org->email);
            Mail::send('emails.assigned', ['case_id' => $litigation->case_id, 'litigation' => $litigation], function ($message) use ($org) {
                $message->from('admin@mcaconnect.org', 'RIMS Notification');
                $message->to($org->email);
                $message->bcc('bazlur.rashid@dnet.org.bd');
                $message->subject("New Case has been assigned to your organization");

            });
        }
    }

    public static function createCaseEmail($lid)
    {
        $litigation = Litigation::findOrFail($lid);
        Mail::send('emails.created', ['case_id' => $litigation->case_id, 'litigation' => $litigation], function ($message) {
            $message->from('admin@mcaconnect.org', 'RIMS Notification');
            $message->to('bazlur.rashid@dnet.org.bd');
            $message->subject("New case has been created");

        });
    }
}
