<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CareRequest;
use App\Care;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Attachment;

class CareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct()
    {
        $this->middleware('deny.admin', ['only' => ['update','store']]);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CareRequest $request)
    {


        $care = new Care();
        $care->action_summary = $request->input('action_summary');
        $care->date = date('Y-m-d', strtotime($request->input('date')));
        $care->notes = $request->input('notes');
        $care->service_id = $request->input('service_type');
        $care->litigation_id = $request->input('litigation_id');
        $care->reference_id = $request->input('reference_no');
        $care->user_id = Auth::user()->id;

        if($request->file('form_attachment')!=null){
            $form_attachment = Attachment::prepareAttachment($request->file('form_attachment'),$doc_type_id=1, $request->input('litigation_id'));
        }
        else {
            if(!empty($form)) {
                $form_attachment = ($request->input('deleted')==0) ? $form->attachment : null;
            }
            else {
                $form_attachment = null;
            }
        }

        $care->attachment = $form_attachment;
       // dd($form_attachment);

        $care->save();

        $request->session()->flash('message', 'Care Plan Created Successfully');

        return back();
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->input('date'));

        $care = Care::findOrFail($id);
        $care->action_summary = $request->input('action_summary');
        $care->date = date('Y-m-d', strtotime($request->input('date')));
        $care->notes = $request->input('notes');
        $care->service_id = $request->input('service_type');
        $care->litigation_id = $request->input('litigation_id');
        $care->reference_id = $request->input('reference_no');
        $care->user_id = Auth::user()->id;

        if($request->file('form_attachment')!=null){
            $form_attachment = Attachment::prepareAttachment($request->file('form_attachment'),$doc_type_id=1, $request->input('litigation_id'));
        }
        else {
            if(!empty($care)) {
                $form_attachment = ($request->input('deleted')==0) ? $care->attachment : null;
            }
            else {
                $form_attachment = null;
            }
        }

        $care->attachment = $form_attachment;
        // dd($form_attachment);

        $care->save();

        $request->session()->flash('message', 'Care Plan Updated Successfully');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $care = Care::findOrFail($id);
        $care->delete();
        $request->session()->flash('message', 'Care Plan Deleted Successfully');
        return back();
    }

}
