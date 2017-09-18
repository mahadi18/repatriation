<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Litigation;
use App\Organization;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\Paginator;


class SearchController extends Controller
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
    public function litigation(Request $request)
    {
        $query = $request->input('query');
        $litigations = Litigation::search($query, true, false)->get();
        return view('search.litigations', compact('litigations','query'));
    }

    public function all(Request $request)
    {

        $litigations = Litigation::search($request->input('query'))->get();
        $organizations = Organization::search($request->input('query'))->get();
        $array = array_merge($litigations->toArray(), $organizations->toArray());

        $new_collections = $litigations->merge($organizations);
       // dd($new_collections);

        return view('search.index', compact('new_collections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
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
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
