<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CarePlanRequest;
use App\Http\Controllers\Controller;

use App\CarePlan;
use Illuminate\Http\Request;
use App\Classes\Usability;

class CarePlanController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */



	public function index()
	{
        $items_per_page = Usability::$item_per_page;
		$careplans = CarePlan::paginate($items_per_page);
		return view('careplans.index', compact('careplans'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('careplans.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(CarePlanRequest $request)
	{
		$careplan = new CarePlan();
		$careplan->title = $request->input("title");
        $careplan->description = $request->input("description");

		$careplan->save();

		return redirect()->route('careplans.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$careplan = CarePlan::findOrFail($id);

		return view('careplans.show', compact('careplan'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$careplan = CarePlan::findOrFail($id);

		return view('careplans.edit', compact('careplan'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(CarePlanRequest $request, $id)
	{
		$careplan = CarePlan::findOrFail($id);

		$careplan->title = $request->input("title");
        $careplan->description = $request->input("description");

		$careplan->save();

		return redirect()->route('careplans.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$careplan = CarePlan::findOrFail($id);
		$careplan->delete();

		return redirect()->route('careplans.index')->with('message', 'Item deleted successfully.');
	}

}
