<?php namespace App\Http\Controllers;

use App\Address;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Litigation;
use App\Ngohir;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Classes\Usability;
use ValidateRequests;

class NgohirController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */



    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('deny.admin', ['only' => ['update','store']]);
    }


	public function index()
	{
		$ngohirs = Ngohir::all();

		return view('ngohirs.index', compact('ngohirs'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
        $litigation = Litigation::findOrFail($id);

		return view('ngohirs.create', compact('litigation'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
     * @param int $id
	 * @return Response
	 */
	public function store(Request $request, $id)
	{
        //return "store()";
        //dd($request->all());

		$ngohir = new Ngohir();

        /*$this->validate($request, [

                'name_of_interviewer' => 'required|regex:/^[A-z ]+$/',
                'place_of_interview' => 'required|regex:/^[A-z ]+$/',
                'date_of_interview' => 'required',
                'name_of_informer' => 'required|regex:/^[A-z ]+$/',
                'survivor_informer_relation' => 'required|regex:/^[A-z ]+$/',
        ]);*/

        $date_of_interview = strtotime($request->input("date_of_interview"));
        $today = strtotime(date('d-m-Y'));
            
        if($today < $date_of_interview)
        {
            return back()->with('error', 'Date of Interview is invalid!! Please enter a valid date.');;
        }

        $ngohir->litigation_id = $id;
        $ngohir->name_of_interviewer = $request->input('name_of_interviewer');

        $ngohir->place_of_interview = $request->input('place_of_interview');

        $ngohir->date_of_interview = $request->has('date_of_interview') ? Carbon::createFromFormat('d-m-Y', $request->input('date_of_interview'), session('user_current_timezone'))->setTimezone('UTC')->toDateString() : null;

        $ngohir->name_of_informer = $request->input('name_of_informer');


        $ngohir->name_of_the_survivor_at_destination = $request->input('name_of_the_survivor_at_destination');


        $ngohir->father_name = $request->input('father_name');
        $ngohir->mother_name = $request->input('mother_name');
        $ngohir->marital_status = $request->input('marital_status');
        $ngohir->spouse_name  = $request->input('spouse_name');
        $ngohir->guardian_occupation  = $request->input('guardian_occupation');
        $ngohir->guardian_monthly_income                = $request->input('guardian_monthly_income');
        $ngohir->eye_color                              = $request->input('eye_color');
        $ngohir->hair_color                             = $request->input('hair_color');
        $ngohir->deformities                            = $request->input('deformities');
        $ngohir->identification_mark                    = $request->input('identification_mark');
        $ngohir->case_filed_by_parents                  = $request->input('case_filed_by_parents') == 1 ? 1 : 0;
        $ngohir->done_over_phone                        = $request->input('done_over_phone') == 1 ? 1 : 0;
        $ngohir->case_filed_no                           = $request->input('case_file_number');

//dd($ngohir->case_filed_by_parents);


        if(($request->input('interview_info')==1)){
            $ngohir->interview_info = 1;
            $portion = 'Interview Information';
        }

        if(($request->input('basic_info')==1)){
            $ngohir->basic_info = 1;
            $portion = 'Survivor Basic Information';
        }

        if(($request->input('address_at_source')==1)){
            $ngohir->address_at_source = 1;
            $portion = 'Address at Source';
        }

        if(($request->input('physical_desc')==1)){
            $ngohir->physical_desc = 1;
            $portion = 'Physical Description';
        }

//        $ngohir->date_of_birth                          = Carbon::createFromFormat('d-m-Y', $request->input('date_of_birth'), session('user_current_timezone'))->setTimezone('UTC')->toDateString();

        if($request->has('age_select')) {
            if(strlen($request->input("dob")) > 0) {
                $ngohir->date_of_birth              = Carbon::createFromFormat('d-m-Y', $request->input('dob'), session('user_current_timezone'))->setTimezone('UTC')->toDateString();
                list($ngohir->age_year_part, $ngohir->age_month_part) = calculate_age($request->input("dob"));
            } else {
                $ngohir->date_of_birth              = null;
                $ngohir->age_year_part              = $request->input("age_year_part");
                $ngohir->age_month_part             = $request->input("age_month_part");
            }
        } else {
            $ngohir->date_of_birth                  = null;
            $ngohir->age_year_part                  = null;
            $ngohir->age_month_part                 = null;
        }

        $ngohir->nationality                            = $request->input('nationality');
        $ngohir->religion                               = $request->input('religion');
        $ngohir->education                              = $request->input('education');
        $ngohir->history_of_previous_stay               = $request->input('history_of_previous_stay');
        $ngohir->height_ft_part                         = $request->input('height_ft_part');
        $ngohir->height_in_part                         = $request->input('height_in_part');
        $ngohir->sex                                    = $request->input('sex');
        $ngohir->birth_mark                             = $request->input('birth_mark');
        $ngohir->complexion                             = $request->input('complexion');
        $ngohir->pregnancy                              = $request->input('pregnancy');
        $ngohir->accompanying_with_survivor             = $request->input('accompanying_with_survivor');
        $ngohir->abuse                                  = $request->input('abuse');
        $ngohir->if_yes_type                            = $request->input('if_yes_type');

        if($ngohir->save()) {
            /* Address Create Start */
            $survivor_address_title = ['present_address', 'native_address'];

            for ($i=0;$i<count($survivor_address_title);$i++) {
                $survivor_address = new Address();

                $survivor_address->litigation_id            = $id;
                $survivor_address->task_id                  = $request->input('task_id');
                $survivor_address->title                    = $survivor_address_title[$i];
                $survivor_address->care_of                  = $request->input('survivor_address_care_of')[$i];
                $survivor_address->relation_with_survivor   = $request->input('relation_with_survivor')[$i];
                $survivor_address->country                  = $request->input('survivor_address_country')[$i];
                $survivor_address->state                    = $request->input('survivor_address_state')[$i];
                $survivor_address->district                 = $request->input('survivor_address_district')[$i];
                $survivor_address->postal_code              = $request->input('survivor_address_postal_code')[$i];
                $survivor_address->address_line_1           = $request->input('survivor_address_line_1')[$i];
                $survivor_address->address_line_2           = $request->input('survivor_address_line_2')[$i];
                $survivor_address->contact_number           = $request->input('survivor_address_contact_number')[$i];

                $survivor_address->save();
            }
            /* Address Create End */
            $in_progress_status_id =  Usability::TaskInProgressStatusID();
            Litigation::saveCaseTask($in_progress_status_id,$id, $request->input('task_id'));
        }

		//return redirect()->route('/cases/show/ngohirs.index', $id)->with('message', 'Item created successfully.');
        return redirect('/cases/'.$request->input('litigation_id').'?tid='.$request->input('task_id'))->with('message', $portion.' Created Successfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ngohir = Ngohir::findOrFail($id);

		return view('ngohirs.show', compact('ngohir'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ngohir = Ngohir::findOrFail($id);

		return view('ngohirs.edit', compact('ngohir'));
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

        //dd($request->all()); /** view: ngohirs/edit_partial ***/

		$ngohir = Ngohir::findOrFail($id);

        //return "update()";

        /*$this->validate($request, [

                'name_of_interviewer' => 'required|regex:/^[A-z ]+$/',
                'place_of_interview' => 'required|regex:/^[A-z ]+$/',
                'date_of_interview' => 'required',
                'name_of_informer' => 'required|regex:/^[A-z ]+$/',
                'survivor_informer_relation' => 'required|regex:/^[A-z ]+$/',


        ]);*/

        $date_of_interview = strtotime($request->input("date_of_interview"));
        $today = strtotime(date('d-m-Y'));
            
        if($today < $date_of_interview)
        {
            return back()->with('error', 'Date of Interview is invalid!! Please enter a valid date.');;
        }

//        $ngohir->litigation_id                          = $id;
        $ngohir->name_of_interviewer                    = $request->has('name_of_interviewer') ? $request->input('name_of_interviewer') : $ngohir->name_of_interviewer;
        $ngohir->place_of_interview                     = $request->has('place_of_interview') ? $request->input('place_of_interview') : $ngohir->place_of_interview;
        $ngohir->date_of_interview                      = $request->has('date_of_interview') ? Carbon::createFromFormat('d-m-Y', $request->input('date_of_interview'), session('user_current_timezone'))->setTimezone('UTC')->toDateString() : $ngohir->date_of_interview;
        $ngohir->name_of_informer                       = $request->has('name_of_informer') ? $request->input('name_of_informer') : $ngohir->name_of_informer;;
//        $ngohir->name_of_the_survivor_at_source         = $request->input('name_of_the_survivor_at_source');
        $ngohir->name_of_the_survivor_at_destination    = $request->has('name_of_the_survivor_at_destination') ? $request->input('name_of_the_survivor_at_destination') : $ngohir->name_of_the_survivor_at_destination;
        $ngohir->father_name                            = $request->has('father_name') ? $request->input('father_name') : $ngohir->father_name;
        $ngohir->mother_name                            = $request->has('mother_name') ? $request->input('mother_name') : $ngohir->mother_name;
        $ngohir->marital_status                         = $request->has('marital_status') ? $request->input('marital_status') : $ngohir->marital_status;
        $ngohir->spouse_name                            = $request->has('spouse_name') ? $request->input('spouse_name'): $ngohir->spouse_name;
//        $ngohir->date_of_birth                          = date('Y-m-d', strtotime($request->input("date_of_birth")));

        if($request->has('age_select')) {
            if(strlen($request->input("dob")) > 0) {
                $ngohir->date_of_birth              = date('Y-m-d', strtotime($request->input("dob")));
                list($ngohir->age_year_part, $ngohir->age_month_part) = calculate_age($request->input("dob"));
            } else {
                $ngohir->date_of_birth              = null;
                $ngohir->age_year_part              = $request->input("age_year_part");
                $ngohir->age_month_part             = $request->input("age_month_part");
            }
        } else {
            $ngohir->date_of_birth                  = $ngohir->date_of_birth ? $ngohir->date_of_birth : null;
            $ngohir->age_year_part                  = $ngohir->age_year_part ? $ngohir->age_year_part : null;;
            $ngohir->age_month_part                 = $ngohir->age_month_part ? $ngohir->age_month_part : null;;
        }

        $ngohir->nationality                            = $request->has('nationality') ? $request->input('nationality') : $ngohir->nationality;
        $ngohir->religion                               = $request->has('religion') ? $request->input('religion') : $ngohir->religion;
        $ngohir->education                              = $request->has('education') ? $request->input('education') : $ngohir->education;
        $ngohir->history_of_previous_stay               = $request->has('history_of_previous_stay') ? $request->input('history_of_previous_stay') : $ngohir->history_of_previous_stay;
        $ngohir->height_ft_part                         = $request->has('height_ft_part') ? $request->input('height_ft_part') : $ngohir->height_ft_part;
        $ngohir->height_in_part                         = $request->has('height_in_part') ? $request->input('height_in_part') : $ngohir->height_in_part;
        $ngohir->sex                                    = $request->has('sex') ? $request->input('sex') : $ngohir->sex;
        $ngohir->birth_mark                             = $request->has('birth_mark') ? $request->input('birth_mark') : $ngohir->birth_mark;
        $ngohir->complexion                             = $request->has('complexion') ? $request->input('complexion') : $ngohir->complexion;
        $ngohir->pregnancy                              = $request->has('pregnancy') ? $request->input('pregnancy') : $ngohir->pregnancy;
        $ngohir->accompanying_with_survivor             = $request->has('accompanying_with_survivor') ? $request->input('accompanying_with_survivor') : $ngohir->accompanying_with_survivor;
        $ngohir->abuse                                  = $request->has('abuse') ? $request->input('abuse') : $ngohir->abuse;
        $ngohir->if_yes_type                            = $request->has('if_yes_type') ? $request->input('if_yes_type') : $ngohir->if_yes_type;
        $ngohir->case_filed_by_parents                  = $request->has('case_filed_by_parents') ? $request->input('case_filed_by_parents') : 0;
        $ngohir->case_filed_no                           = $request->has('case_file_number') ? $request->input('case_file_number') : '';
        $ngohir->done_over_phone                        = $request->has('done_over_phone') ? $request->input('done_over_phone') : 0;
        $ngohir->survivor_informer_relation             = $request->has('survivor_informer_relation') ? $request->input('survivor_informer_relation') : $ngohir->survivor_informer_relation;

        if(($request->input('interview_info')==1)){
            $ngohir->interview_info = 1;
            $portion = 'Interview Information';
        }

        if(($request->input('basic_info')==1)){
            $ngohir->basic_info = 1;
            $portion = 'Survivor Basic Information';
        }

        if(($request->input('address_at_source')==1)){
            $ngohir->address_at_source = 1;
            $portion = 'Address at Source';
        }

        if(($request->input('physical_desc')==1)){
            $ngohir->physical_desc = 1;
            $portion = 'Physical Description';
        }


        if($ngohir->save()) {
            /* Address Edit Start */
            if($request->has('survivor_address_title')) {
                $survivor_address_title = array_merge(['present_address', 'native_address'], $request->input('survivor_address_title'));
            } else {
                $survivor_address_title = ['present_address', 'native_address'];
            }
            
            //dd(count($request->input("address_id")));
            for($i=0;$i<count($request->input("address_id"));$i++) {

                $survivor_address = Address::findOrFail($request->input("address_id")[$i]);

                $survivor_address->title                    = $survivor_address_title[$i];
                $survivor_address->care_of                  = $request->input("survivor_address_care_of")[$i];
                $survivor_address->relation_with_survivor   = $request->input("relation_with_survivor")[$i];
                $survivor_address->country                  = $request->input("survivor_address_country")[$i];
                $survivor_address->state                    = $request->input("survivor_address_state")[$i];
                $survivor_address->district                 = $request->input("survivor_address_district")[$i];
                $survivor_address->postal_code              = $request->input("survivor_address_postal_code")[$i];
                $survivor_address->address_line_1           = $request->input("survivor_address_line_1")[$i];
                $survivor_address->address_line_2           = $request->input("survivor_address_line_2")[$i];
                $survivor_address->contact_number           = $request->input("survivor_address_contact_number")[$i];

                $survivor_address->save();
            }
            /* Address Edit End */
            $in_progress_status_id =  Usability::TaskInProgressStatusID();
            //dd($in_progress_status_id);
            Litigation::saveCaseTask($in_progress_status_id,$request->input('litigation_id'), $request->input('task_id'));
        }

        //return redirect()->route('/cases/show/ngohirs.index', $id)->with('message', 'Item created successfully.');
        return redirect('/cases/'.$request->input('litigation_id').'?tid='.$request->input('task_id'))->with('message', $portion.' Updated Successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$ngohir = Ngohir::findOrFail($id);
		$ngohir->delete();

		return redirect()->route('ngohirs.index')->with('message', 'Item deleted successfully.');
	}

}
