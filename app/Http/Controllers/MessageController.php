<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Organization;

use App\Message;
use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;

class MessageController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */



    public function __construct()
    {
        $this->middleware('notification', ['except' => ['create','sent', 'sentMessage','showMessage','store', 'index','notifications','notifications','allNotifications']]);
    }


	public function index()
	{
		$messages = Message::getInboxMessages();
		return view('messages.index', compact('messages'));
	}

    public function sent(){
        $messages = Message::getSentMessages();
        return view('messages.sent', compact('messages'));
    }

    public function sentMessage()
    {
        $messages = Message::getSentMessages();
        return view('messages.index', compact('messages'));
    }

    public function showMessage($id)
    {
        $message = Message::findOrFail($id);
        Message::messageViewed($id);
        return view('messages.show', compact('message'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $organizations = Organization::all();
		return view('messages.create',compact('organizations'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(MessageRequest $request)
	{
		$message = new Message();
		$message->subject = $request->input("subject");
        $message->body = $request->input("body");
        $message->sender = $request->input("sender");
        $message->parent_message = $request->input("parent_message");
		$message->save();
        $message->organizations()->sync($request->input('organization'));
		return redirect()->route('messages.sent')->with('message', 'Message sent successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        //dd('aaaaa');
        $message = Message::findOrFail($id);
        Message::messageViewed($id);
        return redirect($message->url);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function edit($id)
	{
		$message = Message::findOrFail($id);

		return view('messages.edit', compact('message'));
	}*/

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	/*public function update(Request $request, $id)
	{
		$message = Message::findOrFail($id);

		$message->subject = $request->input("subject");
        $message->body = $request->input("body");
        $message->sender = $request->input("sender");
        $message->receiver = $request->input("receiver");
        $message->parent_message = $request->input("parent_message");

		$message->save();

		return redirect()->route('messages.index')->with('message', 'Item updated successfully.');
	}*/

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		/*$message = Message::findOrFail($id);
		$message->delete();*/

		return redirect()->route('messages.index')->with('message', 'Message cannot be deleted.');
	}


    public function notifications(){
        $notifications = Message::getNgoNotifications();
        return $notifications;
    }

    public function allNotifications(){
        $notifications = Message::getAllNotificationsOfNgo();

        return view('messages.notifications', compact('notifications'));
    }

    public function showNotification($mid){
        $message = Message::getNotificationInfo($mid);
        Message::messageViewed($mid);
        return $message;

    }

}
