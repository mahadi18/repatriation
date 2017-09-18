<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\NgohirfileRequest;
use App\Ngohirfile;
use Illuminate\Support\Facades\Auth;
use App\Attachment;

class NgohirfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */



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
    public function store(NgohirfileRequest $request)
    {
       //dd($request);

        $ngohirfile = new Ngohirfile();
        $ngohirfile->doc_type_id = $request->input('doc_type');
        $ngohirfile->doc_no = $request->input('doc_type');

        if($request->file('form_attachment')!=null){
            $form_attachment = Attachment::prepareAttachment($request->file('form_attachment'),$doc_type_id=$ngohirfile->doc_type, $request->input('litigation_id'));
        }
        else {
            if(!empty($form)) {
                $form_attachment = ($request->input('deleted')==0) ? $form->attachment : null;
            }
            else {
                $form_attachment = null;
            }
        }

        $ngohirfile->attachment = $form_attachment;
        // dd($form_attachment);
        $ngohirfile->litigation_id = $request->input('litigation_id');
        $ngohirfile->user_id = Auth::user()->id;
        $ngohirfile->date_of_upload = \Carbon\Carbon::now()->toDateTimeString();

        $ngohirfile->comments = $request->input('notes');
        //dd(date('d-m-Y'));

        $ngohirfile->save();
        $request->session()->flash('message', 'Ngohirfile Created Successfully');

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
        $ngohirfile = Ngohirfile::findOrFail($id);
        $ngohirfile->doc_type_id = $request->input('doc_type');
        $ngohirfile->doc_no = $request->input('doc_no');

        if($request->file('form_attachment')!=null){
            $form_attachment = Attachment::prepareAttachment($request->file('form_attachment'),$doc_type_id=$ngohirfile->doc_type, $request->input('litigation_id'));
        }
        else {
            if(!empty($form)) {
                $form_attachment = ($request->input('deleted')==0) ? $form->attachment : null;
            }
            else {
                $form_attachment = null;
            }
        }

        $ngohirfile->attachment = $form_attachment;
        // dd($form_attachment);
        $ngohirfile->litigation_id = $request->input('litigation_id');
        $ngohirfile->user_id = Auth::user()->id;
        $ngohirfile->date_of_upload = \Carbon\Carbon::now()->toDateTimeString();

        $ngohirfile->comments = $request->input('notes');
        //dd(date('d-m-Y'));

        $ngohirfile->save();

        $request->session()->flash('message', 'Ngohirfile Updated Successfully');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request,$id)
    {
        $ngohirfile = Ngohirfile::findOrFail($id);
        $ngohirfile->delete();

        $request->session()->flash('message', 'NGO HIR file Deleted Successfully');

        return back();

    }

    public function movements($cid){
        $ngohirfiles = Ngohirfile::where('litigation_id', $cid)->get();
        return $ngohirfiles;
    }
}
