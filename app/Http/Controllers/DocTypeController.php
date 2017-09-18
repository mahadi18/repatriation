<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DocType;
use Illuminate\Http\Request;

class DocTypeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$doctypes = DocType::all();

		return view('doctypes.index', compact('doctypes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('doctypes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$doctype = new DocType();

		$doctype->name = $request->input("name");

		$doctype->save();

		return redirect()->route('doctypes.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$doctype = DocType::findOrFail($id);

		return view('doctypes.show', compact('doctype'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$doctype = DocType::findOrFail($id);

		return view('doctypes.edit', compact('doctype'));
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
		$doctype = DocType::findOrFail($id);

		$doctype->name = $request->input("name");

		$doctype->save();

		return redirect()->route('doctypes.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$doctype = DocType::findOrFail($id);
		$doctype->delete();

		return redirect()->route('doctypes.index')->with('message', 'Item deleted successfully.');
	}

}
