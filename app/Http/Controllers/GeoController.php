<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Country;
use App\State;
use App\District;

class GeoController extends Controller
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
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function countries()
    {
        return Country::all();
    }

    public function states($cid = 0)
    {
        if ($cid) {
            $states = State::where('country_id', $cid)
                ->get();
        } else {
            $states = State::all();
        }
        return $states;
    }

    public function districts($sid = 0)
    {
        if ($sid) {
            $districts = District::where('state_id', $sid)
                ->get();
        } else {
            $districts = District::all();
        }
        return $districts;
    }

    public function addLatLongToState()
    {
        $states = State::all();

        foreach ($states as $state){
            echo $state->name.'</br>';
        }
//        return response($states);
    }


}
