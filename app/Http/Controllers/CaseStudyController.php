<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CaseStudyRequest;
use App\Http\Controllers\Controller;
use App\CaseStudy;
use Illuminate\Support\Facades\Auth;
use App\Litigation;

class CaseStudyController extends Controller
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
        /*$litigations = Litigation::all();
        $case_studies = ['Rescue Story','Victim Statement','Probation Officer Statement'];
        foreach($litigations as $litigation) {
            foreach($case_studies as $case_study){
                $cs= New CaseStudy();
                $cs->litigation_id = $litigation->id;
                $cs->user_id = Auth::user()->id;
                $cs->deletable = 0;
                $cs->title = $case_study;
                $cs->description = '';
                $cs->save();
            }
        }*/
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
    public function store(CaseStudyRequest $request)
    {
        ///dd($request);

        $casestudy = new CaseStudy();
        $casestudy->title = $request->input('title');
        $casestudy->description = $request->input('description');
        //dd($casestudy->description);
        $casestudy->litigation_id = $request->input('litigation_id');
        $casestudy->user_id = Auth::user()->id;

        $casestudy->save();

        return back()->with('message', 'Case Story Added Successfully');
//        return redirect()->back();
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
        ///dd($request);

        $casestudy = CaseStudy::findOrFail($id);
        $casestudy->title = $request->input('title');
        $casestudy->description = $request->input('description');
        //dd($casestudy->description);
        $casestudy->litigation_id = $request->input('litigation_id');
        $casestudy->user_id = Auth::user()->id;

        $casestudy->save();

        return back()->with('message', 'Case Story Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $casestudy = CaseStudy::findOrFail($id);
        $casestudy->delete();

        return redirect('/cases/'.$request->input('litigation_id').'?tid='.$request->input('task_id').'&sub_task='.$request->input('sub_task'));
    }

}
