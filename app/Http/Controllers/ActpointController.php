<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Actpoint;
use Illuminate\Http\Request;

class ActpointController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$actpoints = Actpoint::all();

		return view('actpoints.index', compact('actpoints'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('actpoints.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$actpoint = new Actpoint();

		$actpoint->title = $request->input("title");

		$actpoint->save();

		return redirect()->route('actpoints.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$actpoint = Actpoint::findOrFail($id);

		return view('actpoints.show', compact('actpoint'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$actpoint = Actpoint::findOrFail($id);

		return view('actpoints.edit', compact('actpoint'));
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
		$actpoint = Actpoint::findOrFail($id);

		$actpoint->title = $request->input("title");

		$actpoint->save();

		return redirect()->route('actpoints.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$actpoint = Actpoint::findOrFail($id);
		$actpoint->delete();

		return redirect()->route('actpoints.index')->with('message', 'Item deleted successfully.');
	}

}
