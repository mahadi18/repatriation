<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Movement;

class MovementController extends Controller
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
    public function store(Request $request)
    {
       //dd($request);

        $movement = new Movement();
        $movement->organization_id = $request->input('organization');
//        $movement->entry_date = date('Y-m-d', strtotime($request->input('entry_date')));
        $movement->entry_date = strlen($request->input("entry_date")) > 0 ? Carbon::createFromFormat('d-m-Y', $request->input("entry_date"), session('user_current_timezone'))->setTimezone('UTC')->toDateString() : null;
        $movement->transfer_date = strlen($request->input("transfer_date")) > 0 ? Carbon::createFromFormat('d-m-Y', $request->input("transfer_date"), session('user_current_timezone'))->setTimezone('UTC')->toDateString() : null;
        $movement->litigation_id = $request->input('litigation_id');
        $movement->handed_to = $request->input('handed_to');
        $movement->destination_type = $request->input('organization_type');
        $movement->designation = $request->input('designation');
        $movement->notes = $request->input('notes');

        $movement->save();
        $request->session()->flash('message', 'Movement Created Successfully');

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
        $movement = Movement::findOrFail($id);
        $movement->organization_id = $request->input('organization');
        //$movement->district_id = $request->input('district');
        $movement->entry_date = strlen($request->input("entry_date")) > 0 ? Carbon::createFromFormat('d-m-Y', $request->input("entry_date"), session('user_current_timezone'))->setTimezone('UTC')->toDateString() : null;
        $movement->transfer_date = strlen($request->input("transfer_date")) > 0 ? Carbon::createFromFormat('d-m-Y', $request->input("transfer_date"), session('user_current_timezone'))->setTimezone('UTC')->toDateString() : null;
        $movement->litigation_id = $request->input('litigation_id');
        $movement->handed_to = $request->input('handed_to');
        $movement->destination_type = $request->input('organization_type');
        $movement->designation = $request->input('designation');
        $movement->notes = $request->input('notes');
        //$movement->country = $request->input('country');

        $movement->save();
        $request->session()->flash('message', 'Movement Updated Successfully');

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
        $movement = Movement::findOrFail($id);
        $movement->delete();

        $request->session()->flash('message', 'Movement Deleted Successfully');

        return back();

    }

    public function movements($cid){
        $movements = Movement::where('litigation_id', $cid)->get();
        return $movements;
    }
}
