<?php namespace App\Http\Controllers;

use App\Classes\Countries;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Form;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\FormRequest;
use App\Attachment;
use App\Litigation;
use App\Country;
use App\Classes\Usability;
use App\Organization;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\FormField;

class FormController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


    public function __construct()
    {
        $this->middleware('deny.admin', ['only' => ['saveCaseForm']]);
    }

	public function index()
	{
		$forms = Form::orderBy('task_id','ASC')
            ->orderBy('order', 'ASC')
            ->get();

		return view('forms.index', compact('forms'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $tasks = Task::all();
        $countries = Country::where('id','!=',2)->get();
		return view('forms.create', compact('tasks','countries'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$form = new Form();



		$form->title = $request->input("title");
        $form->task_id = $request->input("task_id");
        $form->order = $request->input("order");
        $form->country_id = $request->input("country_id");

        //return $form->title;

		$form->save();


		return redirect()->route('forms.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$form = Form::findOrFail($id);
        $fields = FormField::where('form_id', $id)->orderBy('order', 'asc')->get();
        //dd($fields);
		return view('forms.show', compact('form','fields'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$form = Form::findOrFail($id);

        $tasks = Task::all();
        $countries = Country::where('id','!=',2)->get();
        /*echo '<pre>';
        print_r($tasks);
        echo '</pre>';*/

        return view('forms.edit', compact('form','tasks','countries'));
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

		$form = Form::findOrFail($id);

        $form->title = $request->input("title");
        $form->task_id = $request->input("task_id");
        $form->order = $request->input("order");
        $form->country_id = $request->input("country_id");
        $form->generic = $request->input("generic");

		$form->save();

		return redirect()->route('forms.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$form = Form::findOrFail($id);
		$form->delete();

		return redirect()->route('forms.index')->with('message', 'Item deleted successfully.');
	}


    public function saveCaseForm(FormRequest $request,$id){
        //dd($request->file('form_attachment'));
        $form = Form::getLitigationOfForm($id,$request->input('litigation_id'));
       // dd($request->input());


        $lid = $request->input('litigation_id');
        $tid = $request->input('task_id');
        $in_progress_status_id =  Usability::TaskInProgressStatusID();
        //dd($lid.$tid.$in_progress_status_id);


        $capable = Litigation::getCapabilityToSaveTask($lid, $tid);
        //dd($capable);
        if ($capable) {
           // $status = ($request->input('status')) ? 1 : 1;
            $status = 1; //make form status to in progress
            $date_of_action = strlen($request->input('date_of_action')) > 0 ? Carbon::createFromFormat('d-m-Y', $request->input('date_of_action'), session('user_current_timezone'))->setTimezone('UTC')->toDateString() : null;
            $date_of_acknowledgement = strlen($request->input('date_of_acknowledgement')) > 0 ? Carbon::createFromFormat('d-m-Y', $request->input('date_of_acknowledgement'), session('user_current_timezone'))->setTimezone('UTC')->toDateString() : null;
            if($request->file('form_attachment')!=null){
                //todo add doc type id add according to document types
                $form_attachment = Attachment::prepareAttachment($request->file('form_attachment'),$doc_type_id=999, $request->input('litigation_id'));
            }
            else {
                if(!empty($form)) {
                    $form_attachment = ($request->input('deleted')==0) ? $form->attachment : null;
                }
                else {
                    $form_attachment = null;
                }
            }
            $form_id= $id;
            if($form){
                Form::updateFormForLitigation($form->litigation_id,$form_id,$date_of_action,
                    $date_of_acknowledgement,$status,$form_attachment);
            }

            else {
                $litigation_id = $request->input('litigation_id');
                Form::insertFormForLitigation($litigation_id,$form_id,$date_of_action,
                    $date_of_acknowledgement,$status,$form_attachment);

            }

            //dd($request->input());
            if($request->input('generic')==0) {
                $fields = array();
                foreach($request->input() as $key => $input) {
                    $exp_key = explode('-', $key);
                    //dd($exp_key);
                    if($exp_key[0] == 'field'){
                        $fields[$key] = $input;
                    }
                }
                //dd($fields);
                Form::saveCustomFields($fields,$lid);
            }
            Litigation::saveCaseTask($in_progress_status_id,$lid, $tid);
            return back()->with('message', 'Form Saved Successfully.');
        } else {
            return redirect()->action('LitigationController@dashboard', [$lid]);
        }


        return redirect('/cases/'.$request->input('litigation_id').'?tid='.$request->input('task_id'))->with('message', 'Item saved Successfully.');
    }

}
