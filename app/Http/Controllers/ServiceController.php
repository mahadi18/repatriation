<?php namespace App\Http\Controllers;

use App\CarePlan;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$services = Service::all();

		return view('services.index', compact('services'));
	}

    public function services($id)
	{

        $services = Service::where('care_plan_id', $id)
            ->get();

		return $services;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $care_types = CarePlan::all();
		return view('services.create', compact('care_types'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$service = new Service();

		$service->title = $request->input("title");
        $service->body = $request->input("body");
        $service->care_plan_id = $request->input("care_type");

		$service->save();

		return redirect()->route('services.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$service = Service::findOrFail($id);

		return view('services.show', compact('service'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$service = Service::findOrFail($id);

		return view('services.edit', compact('service'));
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
		$service = Service::findOrFail($id);

		$service->title = $request->input("title");
        $service->body = $request->input("body");

		$service->save();

		return redirect()->route('services.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$service = Service::findOrFail($id);
		$service->delete();

		return redirect()->route('services.index')->with('message', 'Item deleted successfully.');
	}

}
