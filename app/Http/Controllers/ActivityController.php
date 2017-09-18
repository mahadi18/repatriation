<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ActivityRequest;
use App\Http\Controllers\Controller;
use App\Classes\Usability;

use App\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller {


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items_per_page = Usability::$item_per_page;
        $activities = Activity::paginate($items_per_page);

        return view('activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('activities.create', compact('activities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(ActivityRequest $request)
    {
        $activity = new Activity();
        $activity->title = $request->input("title");
        $activity->save();

        return redirect()->route('activities.index')->with('message', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $activity = Activity::findOrFail($id);

        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $activity = Activity::findOrFail($id);

        return view('activities.edit', compact('activities', 'activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update(ActivityRequest $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->title = $request->input("title");
        $activity->save();

        return redirect()->route('activities.index')->with('message', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('activities.index')->with('message', 'Item deleted successfully.');
    }


}
