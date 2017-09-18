<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ProceedingRequest;
use App\Http\Controllers\Controller;
use App\Proceeding;

class ProceedingController extends Controller
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
    public function store(ProceedingRequest $request)
    {
        $action_point_ids = array();
        foreach($request->input('action_points') as $key => $rackp) {
            $action_point_ids[] = $key;
        }
       // dd($action_point_ids);

        $proceeding = new Proceeding();
        $proceeding->date_of_order = date('Y-m-d', strtotime($request->input('date_of_order')));
        $proceeding->litigation_id = $request->input('litigation_id');
        $proceeding->act = $request->input('act');
        $proceeding->document_type = $request->input('document_type');
        $proceeding->order_from = $request->input('order_from');
        //$proceeding->action_points = implode(",", $request->input('action_points'));
        $proceeding->notes = $request->input('notes');
        $proceeding->save();
        $proceeding->actpoints()->sync($action_point_ids);
        //dd($proceeding);
        $request->session()->flash('message', 'Proceeding Created Successfully');



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
        $proceeding = Proceeding::findOrFail($id);

        $action_point_ids = array();
        foreach($request->input('action_points') as $key => $rackp) {
            $action_point_ids[] = $key;
        }
        //dd($action_point_ids);

        $proceeding->date_of_order = date('Y-m-d', strtotime($request->input('date_of_order')));
        $proceeding->litigation_id = $request->input('litigation_id');
        $proceeding->act = $request->input('act');
        $proceeding->document_type = $request->input('document_type');
        $proceeding->order_from = $request->input('order_from');
        //$proceeding->action_points = implode(",", $request->input('action_points'));
        $proceeding->notes = $request->input('notes');
        $proceeding->save();
        $proceeding->actpoints()->sync($action_point_ids);
        $request->session()->flash('message', 'Proceeding Updated Successfully');
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
        //dd($_SERVER['HTTP_REFERER']);
        $proceeding = Proceeding::findOrFail($id);
        $proceeding->delete();
        $request->session()->flash('message', 'Proceeding Deleted Successfully');
        return back();

        //return redirect()->route('proceedings.index')->with('message', 'Item deleted successfully.');
    }

    public function proceedings($cid){
        $proceedings = Proceeding::where('litigation_id', $cid)->get();
        return $proceedings;
    }
}
