<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\TaskStatusRequest;
use App\Http\Controllers\Controller;
use App\Classes\Usability;

use App\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $items_per_page = Usability::$item_per_page;
        $taskstatuses = TaskStatus::paginate($items_per_page);

		return view('taskstatuses.index', compact('taskstatuses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('taskstatuses.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(TaskStatusRequest $request)
	{
		$taskstatus = new TaskStatus();

		$taskstatus->name = $request->input("name");

		$taskstatus->save();

		return redirect()->route('taskstatuses.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$taskstatus = TaskStatus::findOrFail($id);

		return view('taskstatuses.show', compact('taskstatus'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$taskstatus = TaskStatus::findOrFail($id);

		return view('taskstatuses.edit', compact('taskstatus'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(TaskStatusRequest $request, $id)
	{
		$taskstatus = TaskStatus::findOrFail($id);

		$taskstatus->name = $request->input("name");

		$taskstatus->save();

		return redirect()->route('taskstatuses.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$taskstatus = TaskStatus::findOrFail($id);
		$taskstatus->delete();

		return redirect()->route('taskstatuses.index')->with('message', 'Item deleted successfully.');
	}

}
