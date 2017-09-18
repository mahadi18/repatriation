<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes\Usability;

use App\ServiceManagement;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceManagementRequest;

class ServiceManagementController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $items_per_page = Usability::$item_per_page;
        $servicemanagements = ServiceManagement::paginate($items_per_page);

		return view('servicemanagements.index', compact('servicemanagements'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('servicemanagements.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(ServiceManagementRequest $request)
	{
		$servicemanagement = new ServiceManagement();

		$servicemanagement->title = $request->input("title");
        $servicemanagement->description = $request->input("description");

		$servicemanagement->save();

		return redirect()->route('servicemanagements.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$servicemanagement = ServiceManagement::findOrFail($id);

		return view('servicemanagements.show', compact('servicemanagement'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$servicemanagement = ServiceManagement::findOrFail($id);

		return view('servicemanagements.edit', compact('servicemanagement'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(ServiceManagementRequest $request, $id)
	{
		$servicemanagement = ServiceManagement::findOrFail($id);

		$servicemanagement->title = $request->input("title");
        $servicemanagement->description = $request->input("description");

		$servicemanagement->save();

		return redirect()->route('servicemanagements.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$servicemanagement = ServiceManagement::findOrFail($id);
		$servicemanagement->delete();

		return redirect()->route('servicemanagements.index')->with('message', 'Item deleted successfully.');
	}

}
