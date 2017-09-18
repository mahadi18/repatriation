<?php namespace App\Http\Controllers;

use App\CaseStudy;
use App\Child;
use App\Country;
use App\DocType;
use App\FamilyMember;
use App\Http\Requests;
use App\Http\Requests\LitigationPersonalInformationAddressRequest;
use App\Http\Requests\LitigationPersonalInformationChildInfoRequest;
use App\Http\Requests\LitigationPersonalInformationFamilyMemberInfoRequest;
use App\Http\Requests\LitigationPersonalInformationRequest;
use App\Http\Requests\LitigationRequest;
use App\Http\Controllers\Controller;

use App\Classes\Countries;
use App\Classes\Usability;

use App\Litigation;
use App\Message;
use App\Movement;
use App\ShelterHome;
use App\CarePlan;
use App\CaseProfile;
use App\Attachment;
use App\Address;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\TaskStatus;
use Illuminate\Support\Facades\DB;
use App\Organization;
use App\User;
use App\Form;


class LitigationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct()
    {
        //todo
        $this->middleware('eligible', ['except' => ['create', 'store','index',
            'dashboard','show','updatePersonalInformationFamilyMemberInfo','deletePersonalInformationFamilyMemberInfo',
            'saveCaseTaskStatus']]);
        $this->middleware('task.visibility', ['only' => ['show']]);
        $this->middleware('deny.admin', ['only' => ['update','updatePersonalInformation','saveCaseTaskStatus']]);
    }

    public function index()
    {

        $logged_organization = Organization::getLoggedOrganization();
        $organization = Organization::findOrFail($logged_organization);

        $status = isset($request['status']) ? $request['status'] : 'open';
        $items_per_page = isset($request['items_per_page']) ? $request['items_per_page'] : 10;
        if(Auth::user()->roles[0]->name=='owner' || get_organization_country(Auth::user()->organization_id)==2) {
            $country_of_origin = isset($request['country_of_origin']) ? $request['country_of_origin'] : 0;
        }
        else {
            $country_of_origin = 0;
        }
        //dd(Auth::user()->roles[0]->name);

        if(Auth::user()->roles[0]->name=='contributor'){
            $litigations = Litigation::getAssignedLitigationsWithTasks($logged_organization,'open',10,0);
        }

        else {
            $litigations = Litigation::allLitigationsWithTasks('open',10,0);
        }


        foreach($litigations as $litigation){

            $litigation->tasks = Litigation::getTasksForOrganization($organization->country,$logged_organization,$litigation->id,0);
            $litigation->continious_tasks = Litigation::getAccessbileTasks($litigation->id,1);
            //dd($litigation);
            $litigation->victim_pic = Attachment::getAttachemntForLitigation($litigation->id);
            $litigation->country = Country::getCountryNameFromID($litigation->nationality);
            //dd($litigation->country);
            //$litigation->country_name = Litigation::country_name($litigation->country_of_origin);
            foreach($litigation->tasks as $task){
                $task_status = TaskStatus::findOrFail($task->task_status_id);
                $task->status = $task_status->name;
                $task->url = Task::getURLfromTaskID($task->id);
                $user = User::findOrFail($task->updated_by);
                $task->updator_organization = $user->organization()->get()[0]->name;
            }



        }
        //dd($litigations);
        return view('organizations.dashboard', compact('litigations','status','items_per_page','country_of_origin'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('litigations.create');
    }

    /**
     * Merge rescue date and rescue time and convert it to UTC time from user's timezone
     * @param $rescue_date
     * @param $rescue_time
     * @return string
     */
    protected function rescued_at_utc($rescue_date, $rescue_time) {
        return Carbon::createFromFormat('d-m-Y h:i A', $rescue_date . $rescue_time, session('user_current_timezone'))
            ->setTimezone('UTC')
            ->toDateTimeString(); // 1975-05-21 22:00:00
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(LitigationRequest $request)
    {

        $litigation = new Litigation();

        $litigation->created_by_id                      = auth()->user()->id;
        $litigation->rescued_from_country               = Country::where('name', 'India')->first()->id;
        $litigation->case_id                            = set_case_id($litigation->rescued_from_country);
        $litigation->name_during_rescue                 = $request->input("name_during_rescue");
        $litigation->sex                                = $request->input("sex");

        if (strlen($request->input("rescue_date")) > 0 && strlen($request->input("rescue_time")) > 0) {
            $litigation->rescue_date                         = Carbon::createFromFormat('d-m-Y', $request->input("rescue_date"), session('user_current_timezone'))->setTimezone('UTC')->toDateString();
            $litigation->rescue_time                         = Carbon::createFromFormat('h:i A', $request->input("rescue_time"), session('user_current_timezone'))->setTimezone('UTC')->toTimeString();
        } elseif (strlen($request->input("rescue_date")) > 0 && !(strlen($request->input("rescue_time")) > 0)) {
            $litigation->rescue_date                         = Carbon::createFromFormat('d-m-Y', $request->input("rescue_date"), session('user_current_timezone'))->setTimezone('UTC')->toDateString();
            $litigation->rescue_time                         = null;
        } elseif (!(strlen($request->input("rescue_date")) > 0) && strlen($request->input("rescue_time")) > 0) {
            $litigation->rescue_date                         = null;
            $litigation->rescue_time                         = Carbon::createFromFormat('h:i A', $request->input("rescue_time"), session('user_current_timezone'))->setTimezone('UTC')->toTimeString();
        } else {
            $litigation->rescue_date                         = null;
            $litigation->rescue_time                         = null;
        }

        // $litigation->rescued_at                         = date('Y-m-d', strtotime($request->input("rescue_date"))) .' '. date('G:i', strtotime($request->input("rescue_time"))).':00';
        $litigation->rescued_from_address               = $request->input("rescued_from_address");
        $litigation->rescued_from_state                 = $request->input("rescued_from_state");
        $litigation->rescued_from_district              = $request->input("rescued_from_district");
        $litigation->rescued_by                         = $request->input("rescued_by");
        $litigation->concerned_police_station_of_gd     = $request->input("concerned_police_station_of_gd");
        $litigation->concerned_police_station_of_fir    = $request->input("concerned_police_station_of_fir");
        $litigation->concerned_organization             = $request->input("concerned_organization");
        $litigation->nature_of_complaint                = $request->input("nature_of_complaint");
        $litigation->gd_number                          = $request->input("gd_number");
        $litigation->gd_date                            = strlen($request->input("gd_date")) > 0 ? Carbon::createFromFormat('d-m-Y', $request->input("gd_date"), session('user_current_timezone'))->setTimezone('UTC')->toDateString() : null;
        $litigation->fir_number                         = $request->input("fir_number");
        $litigation->fir_date                           = strlen($request->input("fir_date")) > 0 ? Carbon::createFromFormat('d-m-Y', $request->input("fir_date"), session('user_current_timezone'))->setTimezone('UTC')->toDateString() : null;
        $litigation->nationality                        = $request->input("nationality");
        $litigation->country_of_origin                  = $request->input("nationality");

        if(isset($_POST['age_select'])) {
            if(strlen($request->input("dob")) > 0) {
                $litigation->date_of_birth              = date('Y-m-d', strtotime($request->input("dob")));
                list($litigation->age_year_part, $litigation->age_month_part) = calculate_age($request->input("dob"));
            } else {
                $litigation->date_of_birth              = null;
                $litigation->age_year_part              = $request->input("age_year_part");
                $litigation->age_month_part             = $request->input("age_month_part");
            }
        } else {
            $litigation->date_of_birth                  = null;
            $litigation->age_year_part                  = null;
            $litigation->age_month_part                 = null;
        }

        $org[]=Auth::user()->organization_id;
        //dd($org);

        if( $litigation->save()){
            Litigation::initializeLitigationAccess($litigation->id);
            $litigation->organizations()->sync($org);
            CaseStudy::initializeForCase($litigation->id);
            Message::createCaseEmail($litigation->id);
        }

        return redirect('/cases/'.$litigation->id.'?tid=1&sub_task=4')->with('message', 'Case Created Successfully; Please fill up the following information');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        //dd($id);
        $litigation = Litigation::findOrFail($id);
        $tasks = Litigation::getAccessbileTasks($id,$parent=0);
        $parent_task_id = $request->input("tid") ? $request->input("tid") : 1; //task id of intake from task table

        if($request->input("tid")){
            if($request->input("tid")<2){
                $parent_task_id = $request->input("tid");
            }
        }

        $information = array();
        $sub_tasks = Litigation::getAccessbileTasks($id,$parent_task_id);
        //dd($sub_tasks);
        if(!empty($sub_tasks)){
            $task_id_to_show = $request->input("sub_task") ? $request->input("sub_task") : $sub_tasks[0]->id;
        }

        else {
            $task_id_to_show = $request->input("tid");
        }

        try {
            $template_task = Task::findOrFail($task_id_to_show);
        } catch (\Exception $e) {
            return back();
        }

        $litigation->attachment = Attachment::getAttachemntForLitigation($id);

        //dd($task_id_to_show);
        $information = Litigation::getCaseInfoWithTasks($template_task,$id);
        //dd($information);

        return view('litigations.show', compact('information','litigation','tasks','sub_tasks','parent_task_id','template_task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $litigation = Litigation::findOrFail($id);

        return view('litigations.edit', compact('litigation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Request $request
     * @return Response
     */
    public function update(LitigationRequest $request, $id)
    {
        $litigation = Litigation::findOrFail($id);

        $litigation->name_during_rescue                 = $request->input("name_during_rescue");
        $litigation->sex                                = $request->input("sex");
//        $litigation->rescued_at                         = $this->rescued_at_utc($request->input("rescue_date"), $request->input("rescue_time"));

        if (strlen($request->input("rescue_date")) > 0 && strlen($request->input("rescue_time")) > 0) {
            $litigation->rescue_date                         = Carbon::createFromFormat('d-m-Y', $request->input("rescue_date"), session('user_current_timezone'))->setTimezone('UTC')->toDateString();;
            $litigation->rescue_time                         = Carbon::createFromFormat('h:i A', $request->input("rescue_time"), session('user_current_timezone'))->setTimezone('UTC')->toTimeString();
        } elseif (strlen($request->input("rescue_date")) > 0 && !(strlen($request->input("rescue_time")) > 0)) {
            $litigation->rescue_date                         = Carbon::createFromFormat('d-m-Y', $request->input("rescue_date"), session('user_current_timezone'))->setTimezone('UTC')->toDateString();;
            $litigation->rescue_time                         = null;
        } elseif (!(strlen($request->input("rescue_date")) > 0) && strlen($request->input("rescue_time")) > 0) {
            $litigation->rescue_date                         = null;
            $litigation->rescue_time                         = Carbon::createFromFormat('h:i A', $request->input("rescue_time"), session('user_current_timezone'))->setTimezone('UTC')->toTimeString();
        } else {
            $litigation->rescue_date                         = null;
            $litigation->rescue_time                         = null;
        }

        $litigation->rescued_from_address               = $request->input("rescued_from_address");
        $litigation->rescued_from_state                 = $request->input("rescued_from_state");
        $litigation->rescued_from_district              = $request->input("rescued_from_district");
        $litigation->rescued_by                         = $request->input("rescued_by");
        $litigation->concerned_police_station_of_gd     = $request->input("concerned_police_station_of_gd");
        $litigation->concerned_police_station_of_fir    = $request->input("concerned_police_station_of_fir");
        $litigation->concerned_organization             = $request->input("concerned_organization");
        $litigation->nature_of_complaint                = $request->input("nature_of_complaint");
        $litigation->gd_number                          = $request->input("gd_number");
        $litigation->gd_date                            = strlen($request->input("gd_date")) > 0 ? Carbon::createFromFormat('d-m-Y', $request->input("gd_date"), session('user_current_timezone'))->setTimezone('UTC')->toDateString() : null;
        $litigation->fir_number                         = $request->input("fir_number");
        $litigation->fir_date                           = strlen($request->input("fir_date")) > 0 ? Carbon::createFromFormat('d-m-Y', $request->input("fir_date"), session('user_current_timezone'))->setTimezone('UTC')->toDateString() : null;
        $litigation->nationality                        = $request->input("nationality");
        $litigation->country_of_origin                  = $request->input("nationality");

        if(isset($_POST['age_select'])) {
            if(strlen($request->input("dob")) > 0) {
                $litigation->date_of_birth              = date('Y-m-d', strtotime($request->input("dob")));
                list($litigation->age_year_part, $litigation->age_month_part) = calculate_age($request->input("dob"));
            } else {
                $litigation->date_of_birth              = null;
                $litigation->age_year_part              = $request->input("age_year_part");
                $litigation->age_month_part             = $request->input("age_month_part");
            }
        } else {
            $litigation->date_of_birth                  = null;
            $litigation->age_year_part                  = null;
            $litigation->age_month_part                 = null;
        }
/*
        if ($litigation->save()) {
            if ($request->hasFile('attachment')) {
                $oldAttachment = $litigation->attachments()->where('task_id', Usability::getIntakeId()->id)->first();
                if ($oldAttachment) {
                    Attachment::addAttachment($oldAttachment, $request->file('attachment'), $request->input('doc_type_id'), Usability::getIntakeId()->id, $litigation->id);
                } else {
                    Attachment::addAttachment($request->file('attachment'), $request->input('doc_type_id'), Usability::getIntakeId()->id, $litigation->id);
                }
            }
        }
*/
        $litigation->save();


        $notifiables = Organization::notifiableOrgs($id,$tid=2);
        $subject = Auth::user()->organization()->get()[0]->name." has updated  Rescue Story of case <strong>".$litigation->case_id;
        $url = '/cases/'.$id.'?tid='.$tid;
        // dd($subject);
        Message::sendNotification($key='task_status',$subject,$url,$id,$notifiables);

//        return redirect()->route('cases.edit', $id)->with('message', 'Personal Information updated successfully.');
        return redirect('/cases/'.$id.'?tid='.$request->input('task_id').'&sub_task='.$request->input('sub_task'))->with('message', 'Case Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(Request $request,$id)
    {
        $request->session()->flash('message', 'Case Deleted Successfully');
        return back();
       /* $litigation = Litigation::findOrFail($id);
        $litigation->delete();
        return redirect()->route('cases.index')->with('message', 'Item deleted successfully.');*/
    }


    public function saveRepatriation(Request $request, $id)
    {
        //dd($request);
        $litigation = Litigation::findOrFail($id);

        $litigation->repatriation_option = $request->input("repatriation-option");

        if($litigation->save()){
            if($litigation->repatriation_option==1) {
                Litigation::saveCaseTask(2,$id, 16);
                Litigation::saveCaseTask(2,$id, 18);
            }

            else {
                Litigation::saveCaseTask(1,$id, 16);
                Litigation::saveCaseTask(1,$id, 18);
            }
        }


        // dd($subject);

//        return redirect()->route('cases.edit', $id)->with('message', 'Personal Information updated successfully.');
        return back()->with('message','Repatriation Option for '.$litigation->name_during_rescue.' has been Saved');
    }

    public function moveToShelterHome($id)
    {
        $litigation = Litigation::findOrFail($id);
        $shelter_homes = ShelterHome::all();
        $care_plans = CarePlan::all();
        foreach ($care_plans as $care_plan) {
            $cps[$care_plan['id']] = $care_plan['title'];
        }
        return view('litigations.move_to_shelter_home', compact('litigation', 'shelter_homes', 'cps'));
    }

    public function storeToShelterHome(Request $request, $id)
    {
        $litigation = Litigation::findOrFail($id);
        $shelter_home = $request->input("shelter_home");
        $cps = $request->input("cps");
        $litigation->shelter_home_id = $shelter_home;
        $litigation->save();
        return view('litigations.show', compact('litigation'));
    }


    public function attachCarePlan(Request $request, $id)
    {
        $litigation = Litigation::findOrFail($id);
        $cps = $request->input("cps");
        if ($cps) {
            $litigation->carePlans()->sync($cps);
            $care_plan_names = CarePlan::getPlanNamesFromIds($cps);
            Litigation::updateCaseProfile('App\Litigation', $litigation->id, Auth::user()->id, 'Care Planes', $care_plan_names);
        } else {
            $litigation->carePlans()->detach();
            Litigation::updateCaseProfile('App\Litigation', $litigation->id, Auth::user()->id, 'Care Planes', '');
        }

        $care_plans = Litigation::getCarePlanProgress($id);
        $statuses = Usability::getCarePlanStatuses();
        return redirect()->action('LitigationController@updateCarePlans', [$id]);
    }

    public function showCaseProfile($litigation_id)
    {
        $litigation = Litigation::findOrFail($litigation_id);
        $litigation->attachemnt = Attachment::getAttachemntForLitigation($litigation_id);
        $revisions = $litigation->revisionHistory;
        $histories =array();
        foreach($revisions as $revision){

            if($revision->key=='Task Status'){
                $histories[]=$revision;
            }
        }
        /*echo '<pre>';
        dd( $litigation);
        echo '</pre>';*/


            return view('litigations.case_profile', compact('litigation', 'histories'));

    }

    public function fullProfile($litigation_id)
    {
        $litigation = Litigation::findOrFail($litigation_id);
        $litigation->attachemnt = Attachment::getAttachemntForLitigation($litigation_id);
        return view('litigations.full_profile', compact('litigation'));

    }

    public function documentArchive($litigation_id)
    {
        $litigation = Litigation::findOrFail($litigation_id);
        $litigation->form_files = Form::getFormFiles($litigation_id);
        $litigation->attachments = Attachment::getNGOHIRAttachments($litigation_id);
        return view('litigations.document_archive', compact('litigation'));

    }

    public function takeOver($litigation_id)
    {
        $litigation = Litigation::findOrFail($litigation_id);
        $desired_doc_type_ids = [8,9,10];
        $takeover = Attachment::ReceivedDocuments($litigation_id);

        if(!empty($takeover)){
            $received_docs = explode(",", ($takeover[0]->doc_ids));
            $complete = ($takeover[0]->complete !== null) ? $takeover[0]->complete : 0;
        }
        else {
            $received_docs = array();
            $complete = 0;
        }
        //d($takeover[0]->complete);
        //$litigation->received_docs = Attachment::ReceivedDocuments($litigation_id);
        return view('litigations.taken_over', compact('litigation','desired_doc_type_ids','received_docs','complete'));

    }

    public function saveTakeOver(Request $request, $lid)
    {
        $received_docs = Attachment::ReceivedDocuments($lid);
        if(empty($received_docs)) {
            Attachment::saveTakeover($request,$lid);
        }

        else {
            Attachment::updateTakeover($request,$lid);
        }

        return back()->with('message','Takeover Information Updated Successfully');
    }


    public function showChangeLog($litigation_id)
    {
        $litigation = Litigation::findOrFail($litigation_id);
        $litigation->attachemnt = Attachment::getAttachemntForLitigation($litigation_id);
        $revisions = $litigation->revisionHistory;
        $histories =array();
        foreach($revisions as $revision){

            if($revision->key=='Task Status'){
                $histories[]=$revision;
            }
        }
            return view('litigations.change_log', compact('litigation', 'histories'));

    }

    public function carePlanProgress($litigation_id)
    {
        $care_plans = CarePlan::all();
        $cps = array();
        foreach ($care_plans as $care_plan) {
            $cps[$care_plan['id']] = $care_plan['title'];
        }
        $care_plans = Litigation::getCarePlanProgress($litigation_id);
        $statuses = Usability::getCarePlanStatuses();
        $litigation = Litigation::findOrFail($litigation_id);
        return view('litigations.care_plans', compact('litigation', 'care_plans', 'statuses', 'cps'));
    }

    public function updateCarePlans(Request $request, $litigation_id)
    {
        $care_plans = CarePlan::all();
        foreach ($care_plans as $care_plan) {
            $cps[$care_plan['id']] = $care_plan['title'];
        }
        Litigation::saveCarePlanStatus($litigation_id, $request->input('care_plan_id'), $request->input('status'));
        $litigation = Litigation::findOrFail($litigation_id);
        $care_plans = Litigation::getCarePlanProgress($litigation_id);
        $statuses = Usability::getCarePlanStatuses();
        return view('litigations.care_plans', compact('litigation', 'cps', 'care_plans', 'statuses'));
    }

    public function dashboard($lid)
    {
        $litigation = Litigation::findOrFail($lid);

        $litigation->attachment = Attachment::getAttachemntForLitigation($lid);

        $task_statuses = TaskStatus::where('id','!=',1)->orderBy('id', 'desc')->get();
        $tasks = Litigation::getAccessbileTasks($lid,0);
        if (empty($tasks)) {
            return redirect()->action('HomeController@unauthorized');
        }
        $view = view('litigations.dashboard', compact('litigation', 'tasks', 'task_statuses'));


        $additional_tasks = Litigation::getAdditionalTasks($lid);

        if(!empty($additional_tasks)){
            $coupled_country = Litigation::getCoupledCountry(Auth::user(), $lid);
            $additional_country = Countries::Country($coupled_country);
            $view = view('litigations.dashboard', compact('litigation', 'tasks', 'task_statuses', 'additional_tasks', 'additional_country'));
        }


        return $view;
    }

    public function saveCaseTaskStatus(Request $request, $lid, $tid)
    {
        $capable = Litigation::getCapabilityToSaveTask($lid, $tid);
        if ($capable) {
            Litigation::saveCaseTask($request->input('status_id'),$lid, $tid);

            $task_name = Task::findOrFail($tid)->title;
            return back()->with('message', $task_name . ' completed successfully.');
        } else {
            return redirect()->action('LitigationController@dashboard', [$lid]);
        }
    }

    public function assign($litigation_id)
    {
        $litigation = Litigation::findOrFail($litigation_id);
        $tasks = Task::all();
        $task_statuses = TaskStatus::all();
        $countries = Countries::getCountryList();
        $organizations = Organization::all();
        return view('litigations.assign', compact('litigation', 'tasks', 'task_statuses', 'countries'));
    }

    public function saveAssignment(Request $request, $lid)
    {
        Litigation::storeAssignmentInTaskStatus(
            $request->input('status_id'),
            $lid,
            $request->input('task_id'),
            $request->input('country_ids'),
            $request->input('message_id')
        );
        return back();
    }


    public function accessibility($litigation_id)
    {
        $litigation = Litigation::findOrFail($litigation_id);
        $litigation->attachment = Attachment::getAttachemntForLitigation($litigation_id);
        $tasks = Litigation::getAccessbileTasks($litigation_id,$parent=0);
        $organizations = Organization::where('country','=',$litigation->rescued_from_country)
            ->orWhere('country','=',$litigation->country_of_origin)
            ->where('id','!=',1)
            ->get();
        return view('litigations.accessibility', compact('litigation', 'organizations','tasks'));
    }

    public function saveAccessibility(Request $request, $lid)
    {
        $litigation = Litigation::findOrFail($lid);
        $old_organizations = $litigation->organizations()->get();
        if(!empty($old_organizations)){
            $prev_organizations = array();
            foreach($old_organizations as $old_organization){
                $prev_organizations[] +=  $old_organization->id;
            }
        }
        $organizations = array();
        if ($request->input('organization')) {
            $organizations = $request->input('organization');
        }

        array_push($organizations, Organization::getLoggedOrganization());

        $revoked_nids = array_diff($prev_organizations,$organizations);
        $added_nids = array_diff($organizations,$prev_organizations);
        if(!empty($revoked_nids)){
            Message::sendNotification('revoked','','/organization/dashboard/'.$lid,$lid,$revoked_nids);
            $revoked_organizations = Organization::getOrganizationNamesFromIds($revoked_nids);
            Litigation::updateCaseProfile('App\Litigation',$lid, Auth::user()->id,'Access Revoked',$revoked_organizations);
        }
        if(!empty($added_nids)){
            Message::sendNotification('granted','','/cases/'.$lid.'?tid=9',$lid,$added_nids); //TODO redirect the user to appropriate url after being given access to case
            $added_organizations = Organization::getOrganizationNamesFromIds($added_nids);
            Litigation::updateCaseProfile('App\Litigation',$lid, Auth::user()->id,'Access Given',$added_organizations);


            Message::sendAssignmentEmail($lid,$added_nids);

        }
        $litigation->organizations()->sync($organizations);
        return back()->with('message','Contributor List Updated Successfully');
    }

    public function editPersonalInformation($id)
    {
        $litigation = Litigation::findOrFail($id);

//        $family_members = $litigation->family_members;

//        dd($family_members);

        return view('personal-info.edit', compact('litigation'));
    }

    public function updatePersonalInformation(LitigationPersonalInformationRequest $request, $id)
    {
     // dd($request->hasFile('victim_personal_image_attachment'));
        $litigation = Litigation::findOrFail($id);

        $litigation->full_name                  = $request->input("full_name");
        $litigation->nick_name                  = $request->input("nick_name");
        $litigation->father_name                = $request->input("father_name");
        $litigation->mother_name                = $request->input("mother_name");
//        $litigation->date_of_birth              = date('Y-m-d', strtotime($request->input("date_of_birth")));
        $litigation->mother_tongue              = $request->input("mother_tongue");
        $litigation->other_language             = $request->input("other_language");
        $litigation->education                  = $request->input("education");
        $litigation->sex                        = $request->input("sex");
        $litigation->marital_status             = $request->input("marital_status");
        $litigation->spouse_name                = $request->input("spouse_name");
        $litigation->pregnancy                  = $request->input("pregnancy");

        if(isset($_POST['age_select'])) {
            if(strlen($request->input("dob")) > 0) {
                $litigation->date_of_birth              = date('Y-m-d', strtotime($request->input("dob")));
                list($litigation->age_year_part, $litigation->age_month_part) = calculate_age($request->input("dob"));
            } else {
                $litigation->date_of_birth              = null;
                $litigation->age_year_part              = $request->input("age_year_part");
                $litigation->age_month_part             = $request->input("age_month_part");
            }
        } else {
            $litigation->date_of_birth                  = null;
            $litigation->age_year_part                  = null;
            $litigation->age_month_part                 = null;
        }

        if ($litigation->save()) {
            if ($request->hasFile('victim_personal_image_attachment')) {
                /*$oldAttachment = $litigation->attachments()->where('task_id', Usability::getIntakeId()->id)->first();
                if ($oldAttachment) {
                    Attachment::addAttachment($oldAttachment, $request->file('attachment'), $request->input('doc_type_id'), Usability::getIntakeId()->id, $litigation->id);
                } else {
                    Attachment::addAttachment($request->file('attachment'), $request->input('doc_type_id'), Usability::getIntakeId()->id, $litigation->id);
                }*/
                Attachment::addAttachment(null, $request->file('victim_personal_image_attachment'), $request->input('doc_type_id'), $litigation->id);
            }
        }

        $litigation->save();

        for($i=0;$i<count($request->input("address_id"));$i++) {

            $survivor_address = Address::findOrFail($request->input("address_id")[$i]);

            $survivor_address->title                = $request->input("survivor_address_title")[$i];
            $survivor_address->care_of              = $request->input("survivor_address_care_of")[$i];
            $survivor_address->relation_with_survivor = $request->input("relation_with_survivor")[$i];
            $survivor_address->country              = $request->input("survivor_address_country")[$i];
            $survivor_address->state                = $request->input("survivor_address_state")[$i];
            $survivor_address->district             = $request->input("survivor_address_district")[$i];
            $survivor_address->postal_code          = $request->input("survivor_address_postal_code")[$i];
            $survivor_address->address_line_1       = $request->input("survivor_address_line_1")[$i];
            $survivor_address->address_line_2       = $request->input("survivor_address_line_2")[$i];
            $survivor_address->contact_number       = $request->input("survivor_address_contact_number")[$i];

            $survivor_address->save();
        }

        for($i=0;$i<count($request->input("victim_child_id"));$i++) {

            $survivor_child = Child::findOrFail($request->input("victim_child_id")[$i]);

            $survivor_child->full_name              = $request->input("victim_child_name")[$i];
            $survivor_child->date_of_birth          = date('Y-m-d', strtotime($request->input("victim_child_date_of_birth")[$i]));
            $survivor_child->child_litigation_id    = $request->input("victim_child_case_id")[$i];
            $survivor_child->sex                    = $request->input("victim_child_sex-".$survivor_child->id);

            if(!empty($request->input("accompanying_with_survivor")) && in_array((string)$survivor_child->id, $request->input("accompanying_with_survivor"), true)) {
                $survivor_child->accompanying_with_survivor = 1;
            } else {
                $survivor_child->accompanying_with_survivor = 0;
            }

            $survivor_child->save();
        }

        //return redirect()->route('personal.information.edit', $id)->with('message', 'Personal Information updated successfully.');
        return back()->with('message', 'Personal Information Updated Successfully');

    }

    public function storePersonalInformationAddress(LitigationPersonalInformationAddressRequest $request, $id)
    {
        $survivor_address = new Address();

        $survivor_address->litigation_id            = $id;
        $survivor_address->task_id                  = $request->input("task_id");
        $survivor_address->title                    = $request->input("survivor_address_title");
        $survivor_address->care_of                  = $request->input("survivor_address_care_of");
        $survivor_address->relation_with_survivor   = $request->input("relation_with_survivor");
        $survivor_address->country                  = $request->input("survivor_address_country");
        $survivor_address->state                    = $request->input("survivor_address_state");
        $survivor_address->district                 = $request->input("survivor_address_district");
        $survivor_address->postal_code              = $request->input("survivor_address_postal_code");
        $survivor_address->address_line_1           = $request->input("survivor_address_line_1");
        $survivor_address->address_line_2           = $request->input("survivor_address_line_2");
        $survivor_address->contact_number           = $request->input("survivor_address_contact_number");

        $survivor_address->save();

        return back();
    }



    public static function addSurvivorChildAttachment($oldAttachment = null, $attachment_file, $doc_type_id, $survivor_child_id)
    {
        $attachment = new Attachment();

        $attachmentName = '';

        while (true) {
            $attachmentName = str_replace(".","",uniqid( "", true)) . '.' .$attachment_file->getClientOriginalExtension();
            if (!file_exists(sys_get_temp_dir() . $attachmentName)) break;
        }

        $attachment_file->move(public_path() . '/uploads', $attachmentName);

        $attachment->file_name = $attachmentName;
        $attachment->file_size = $attachment_file->getClientSize();
        $attachment->content_type = $attachment_file->getClientMimeType();
        $attachment->file_path = '/uploads/' . $attachmentName;

        // TODO get doc type from the name of the input field for most commonly used types (Robaiatul Islam)
        $attachment->doc_type_id = $doc_type_id;
        $attachment->uploaded_by = auth()->user()->id;

        /*if ($oldAttachment) {

            if (File::exists(public_path() . $oldAttachment->file_path) && $oldAttachment->file_path != null){
                File::delete(public_path() . $oldAttachment->file_path);
            }
            $oldAttachment->delete();

        }*/

        if($attachment->save()) {
            $survivor_child = Child::findOrFail($survivor_child_id);
            $survivor_child->child_image_attachment = '/uploads/' . $attachmentName;

            $survivor_child->save();
        }

//        $attachment->litigations()->sync([$litigation_id]);
    }

    public function storePersonalInformationChildInfo(LitigationPersonalInformationChildInfoRequest $request, $id)
    {

        $survivor_child = new Child();

        $survivor_child->litigation_id          = $id;
        $survivor_child->full_name              = $request->input("victim_child_name");
        $survivor_child->sex                    = $request->input("victim_child_sex");
        $survivor_child->date_of_birth          = date('Y-m-d', strtotime($request->input("victim_child_date_of_birth")));
        $survivor_child->accompanying_with_survivor = $request->input("accompanying_with_survivor");
        $survivor_child->child_litigation_id    = $request->input("victim_child_case_id");

        if ($survivor_child->save()) {
            if ($request->hasFile('victim_child_image_attachment')) {
                /*$oldAttachment = $litigation->attachments()->where('task_id', Usability::getIntakeId()->id)->first();
                if ($oldAttachment) {
                    Attachment::addAttachment($oldAttachment, $request->file('attachment'), $request->input('doc_type_id'), Usability::getIntakeId()->id, $litigation->id);
                } else {
                    Attachment::addAttachment($request->file('attachment'), $request->input('doc_type_id'), Usability::getIntakeId()->id, $litigation->id);
                }*/
                $this->addSurvivorChildAttachment(null, $request->file('victim_child_image_attachment'), $request->input('doc_type_id'), $survivor_child->id);
            }

            return back()->with('message', 'Personal Information Updated Successfully');
        }

        return back();
    }

    public function storePersonalInformationFamilyMemberInfo(LitigationPersonalInformationFamilyMemberInfoRequest $request, $id)
    {

        $family_member = new FamilyMember();

        $family_member->litigation_id           = $id;
        $family_member->full_name               = $request->input("family_member_name");
        $family_member->relation_with_survivor  = $request->input("relation_with_survivor");
        $family_member->age                     = $request->input("age");
        $family_member->occupation              = $request->input("occupation");

        $family_member->save();
        $request->session()->flash('message', 'Family member added');
        return back();

    }

    public function updatePersonalInformationFamilyMemberInfo(LitigationPersonalInformationFamilyMemberInfoRequest $request, $id)
    {

        $family_member = FamilyMember::findOrFail($id);

        $family_member->full_name               = $request->input("family_member_name");
        $family_member->relation_with_survivor  = $request->input("relation_with_survivor");
        $family_member->age                     = $request->input("age");
        $family_member->occupation              = $request->input("occupation");

        $family_member->save();
        $request->session()->flash('message', 'Family member updated');
        return back();

    }




    public function deletePersonalInformationFamilyMemberInfo(Request $request,$id)
    {
        $family_member = FamilyMember::findOrFail($id);
        $family_member->delete();
        $request->session()->flash('message', 'Family member deleted');
        return back();
    }

    public function changeStatus(Request $request, $id){
        $litigation = Litigation::findOrFail($id);
        $litigation->status = $request->input('status');
        $litigation->save();
        $request->session()->flash('message', 'Case status has been changed to '.$litigation->status.' successfully');

        $notifiables = Organization::notifiableOrgs($id,1);
        $subject = Auth::user()->organization()->get()[0]->name." has changed the case status of <strong>".$litigation->case_id."</strong> to ".$litigation->status;
        $url = '/cases/'.$id.'/case-profile';
         //dd($url);
        Message::sendNotification($key='task_status',$subject,$url,$id,$notifiables);

        return back();
    }

}
