<?php namespace App\Http\Controllers;

use App\DocType;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Attachment;
use App\Litigation;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttachmentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$attachments = Attachment::all();

		return view('attachments.index', compact('attachments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $victims = Litigation::all();
        $doc_types = DocType::lists('name', 'id')->all();

		return view('attachments.create', compact('victims', 'doc_types'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$attachment = new Attachment();
        $attachmentName = '';

        while (true) {
            $attachmentName = str_replace(".","",uniqid( "", true)) . '.' .$request->file('attachment')->getClientOriginalExtension();
            if (!file_exists(sys_get_temp_dir() . $attachmentName)) break;
        }

        $request->file('attachment')->move(public_path() . '/uploads', $attachmentName);

        $attachment->file_name = $attachmentName;
        $attachment->official_reference_id = $request->input('official_reference_id');
        $attachment->organizational_reference_id = $request->input('organizational_reference_id');
        $attachment->file_size = $request->file('attachment')->getClientSize();
        $attachment->content_type = $request->file('attachment')->getClientMimeType();
        $attachment->file_path = '/uploads/' . $attachmentName;
        $attachment->doc_type_id = $request->input('doc_type_id');
        $attachment->uploaded_by = Auth::user()->id;

		$attachment->save();

        // Add attachment_id and litigatio_id to the attachment_litigation table with comment
        $case_id_and_comment = [];
        foreach($request->input('case_id') as $key => $value){
            $comment = ['comment' => ( strlen($request->input('comment')[$key]) > 0 ? $request->input('comment')[$key] : null )];
            $case_id_and_comment[$value] = $comment;
        }

        $attachment->litigations()->sync($case_id_and_comment);
        // TODO Litigation::updateCaseProfile('App\Litigation',$litigation->id,Auth::user()->id,'Care Planes',$care_plan_names);

		return redirect()->route('attachments.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$attachment = Attachment::findOrFail($id);

		return view('attachments.show', compact('attachment'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$attachment = Attachment::findOrFail($id);

//        $victims = Litigation::all();
        $victims = Litigation::lists('name_during_rescue', 'id')->all();

        $selected_case_id = [];

        if ($attachment->litigations) {
            foreach ($attachment->litigations as $litigation) {
                $selected_case_id[] = $litigation->id;
            }
        }

		$tasks = Task::lists('title', 'id')->all();

		$doc_types = DocType::lists('name', 'id')->all();

		return view('attachments.edit', compact('attachment', 'victims', 'tasks', 'doc_types', 'selected_case_id'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$attachment = Attachment::findOrFail($id);

        $attachment->doc_type_id = $request->input('doc_type_id');
        $attachment->task_id = $request->input('task_id');

		$attachment->save();

        $attachment->litigations()->sync($request->input('case_id'));

		return redirect()->route('attachments.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$attachment = Attachment::findOrFail($id);
		$attachment->delete();

		return redirect()->route('attachments.index')->with('message', 'Item deleted successfully.');
	}

}
