<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class Attachment extends Model {
    //
    public function litigations()
    {
        return $this->belongsToMany('App\Litigation')->withTimestamps();
    }

//    public function addAttachment($id = null, $attachment_file, $doc_type_id)
    public static function addAttachment($oldAttachment = null, $attachment_file, $doc_type_id, $litigation_id)
    {
        $attachment = new Attachment();

        $attachmentName = '';

        while (true) {
            $attachmentName = str_replace(".","",uniqid( "", true)) . '.' .$attachment_file->getClientOriginalExtension();
            if (!file_exists(sys_get_temp_dir() . $attachmentName)) break;
        }

        $attachment_file->move(public_path() . '/uploads', $attachmentName);

        $attachment->file_name = $attachmentName;
        $attachment->file_size = $attachment_file->getClientSize();
        $attachment->content_type = $attachment_file->getClientMimeType();
        $attachment->file_path = '/uploads/' . $attachmentName;

        // TODO get doc type from the name of the input field for most commonly used types (Robaiatul Islam)
        $attachment->doc_type_id = $doc_type_id;
        $attachment->uploaded_by = auth()->user()->id;

        $attachment->save();
        $attachment->litigations()->sync([$litigation_id]);
    }

    public static function getAttachemntForLitigation($lid){
        //dd($lid);
        $attachment = DB::table('attachment_litigation')
            ->leftjoin('attachments', 'attachment_litigation.attachment_id', '=', 'attachments.id')
            ->where('attachment_litigation.litigation_id', $lid)
            ->select('attachments.file_path')
            ->get();

        return (!empty($attachment)) ? $attachment[0]->file_path : '/uploads/-text.png';
    }

    public static function getNGOHIRAttachments($lid){
        //dd($lid);
        $attachments = DB::table('ngohirfiles')
            ->leftjoin('doc_types', 'doc_types.id', '=', 'ngohirfiles.doc_type_id')
            ->where('ngohirfiles.litigation_id', $lid)
            /*->where('attachments.doc_type_id', '<',999)*/
            ->whereBetween('ngohirfiles.doc_type_id', array('2', '998'))
            ->select('ngohirfiles.*','doc_types.name')
            ->get();

        return $attachments;
    }


    public static function prepareAttachment($form_attachment, $doc_type_id,$litigation_id){
        //dd($form_attachment);
        $attachment = new Attachment();

        $attachmentName = '';

        while (true) {
            $attachmentName = str_replace(".","",uniqid( "", true)) . '.' .$form_attachment->getClientOriginalExtension();
            if (!file_exists(sys_get_temp_dir() . $attachmentName)) break;
        }

        $form_attachment->move(public_path() . '/uploads', $attachmentName);

        $attachment->file_name = $attachmentName;
        $attachment->file_size = $form_attachment->getClientSize();
        $attachment->content_type = $form_attachment->getClientMimeType();
        $attachment->file_path = '/uploads/' . $attachmentName;

        // TODO get doc type from the name of the input field for most commonly used types (Robaiatul Islam)
        $attachment->doc_type_id = $doc_type_id;
        $attachment->uploaded_by = auth()->user()->id;

        $attachment->save();
        $attachment->litigations()->sync([$litigation_id]);

        return $attachment->file_path;
    }


    public static function ReceivedDocuments($lid){
        $objects = DB::table('takeovers')
            ->where('takeovers.litigation_id', $lid)
            ->get();
        return $objects;
    }

    public static function saveTakeover($request=[],$lid){
        $doc_ids = implode (",", $request->input('doc'));
        //dd($request->input('complete'));
        DB::table('takeovers')->insert([
            [
                'doc_ids' => $doc_ids,
                'complete' => $request->input('complete'),
                'litigation_id' => $lid,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }

    public static function updateTakeover($request=[],$lid){
        //dd($request->input('doc'));
        $doc_ids = $request->input('doc') !==null ? implode (",", $request->input('doc')) : null;
        DB::table('takeovers')
            ->where('litigation_id', $lid)
            ->update(array('updated_at' => date('Y-m-d H:i:s'),'doc_ids' => $doc_ids,'complete' => $request->input('complete')));
    }
}
