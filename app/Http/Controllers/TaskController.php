<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\TaskRequest;
use App\Http\Controllers\Controller;
use App\Classes\Usability;
use Illuminate\Support\Facades\DB;
use App\Task;
use Illuminate\Http\Request;
use App\Classes\Countries;


class TaskController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        $items_per_page = Usability::getPaginationPerPage();
//        $tasks = Task::paginate($items_per_page);

        //$tasks = Task::all();

        $tasks = Task::taskMapping();

        //dd($tasks);
        $countries = Countries::getCountryList();

        return view('tasks.index', compact('tasks','countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tasks = Task::lists('title', 'id');

        $activities = DB::table('activities')->lists('title', 'id');
        $country_list = Countries::getCountryList();

        if ($country_list) {
            foreach ($country_list as $country) {
                $countries[$country['id']] = $country['name'];
            }
        }

        return view('tasks.create', compact('tasks', 'activities', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(TaskRequest $request)
    {
        $task = new Task();

        $task->title = $request->input("title");
        $task->parent_id = $request->input("parent_id") ? $request->input("parent_id") : 0;
        $task->countries =implode(",", $request->input("country"));
        // dd($task);
        // dd($request->input());

        $task->save();

        if (count($request->input("previous"))) {

            for ($i = 0; $i < count($request->input("previous")); $i++) {
                $data = array(
                    'from_task' => intval($request->input("previous")[$i]),
                    'to_task'   => $task->id
                );
                DB::table('task_to_task')->insert($data);
            }

        }

        return redirect()->route('tasks.index')->with('message', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
       // $tasks = Task::where('id', '!=', $id)->lists('title', 'id');

        $tasks = Task::lists('title', 'id');
        $task = Task::findOrFail($id);

        //$activities = DB::table('activities')->lists('title', 'id');

        /*$previous_tasks = DB::table('task_to_task')
                              ->select('from_task')
                              ->where('to_task', '=', $id)
                              ->get();*/

//        dd($previous_tasks[0]->from_task);

        $country_list = Countries::getCountryList();

        if ($country_list) {
            foreach ($country_list as $country) {
                $countries[$country['id']] = $country['name'];
            }
        }

//        if(!empty($previous_tasks)) {
//            $previous = [];
//            for($i=0;$i<count($previous_tasks);$i++) {
//                $previous[$i] = $previous_tasks[$i]->from_task;
//            }
//        } else {
//            $previous = null;
//        }

        if($task->countries) {
            $selected_countries = explode(',', $task->countries);
        } else {
            $selected_countries = null;
        }

//        echo "<pre>";
//        print_r($tasks);
//        print_r($task->toArray());
//        print_r($activities);
//        echo "</pre>";
//        die();


        return view('tasks.edit', compact('tasks','task','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->title = $request->input("title");

        $task->parent_id = $request->input("parent_id");

        //dd($request->input("country"));

        $task->countries =implode(",", $request->input("country"));

        $task->save();


        return redirect()->route('tasks.index')->with('message', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('message', 'Item deleted successfully.');
    }

    /**
     * @param $id
     */

}
