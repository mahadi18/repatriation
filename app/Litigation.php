<?php namespace App;

use App\Classes\Countries;
use App\Classes\TreatmentTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Venturecraft\Revisionable\RevisionableTrait; // Model Auditing
use App\CarePlan;
use Illuminate\Support\Facades\Auth;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\Classes\Usability;
use App\Country;
use App\Movement;
use App\Classes\DestinationTypes;
use App\Proceeding;
use App\Actpoint;
use App\Classes\Acts;
use App\Classes\DocumentTypes;
use App\Classes\OrderSources;
use App\CaseStudy;
use App\Care;
use App\District;
use App\Service;
use App\Form;
use App\Message;


class Litigation extends Model
{

    use RevisionableTrait;
    use SearchableTrait;

    protected $dates = ['rescue_date', 'gd_date', 'fir_date'];

    protected $revisionEnabled = true;

    protected $revisionFormattedFieldNames = array(
        'id' => 'ID',
        'case_id' => 'Case ID',
        'full_name' => 'Full Name',
        'name_during_rescue' => 'Name during rescue',
        'rescued_from_address' => 'Rescued from address',
        'country_of_origin' => 'Country',
        'rescued_by' => 'Rescued by',
        'rescued_from_address' => 'Rescue Place',
        'gd_number' => 'GD Number'
    );


    protected $searchable = [
        'columns' => [
            'name_during_rescue' => '10',
            'case_id' => '9',
            'rescued_from_address' => '8',
            'country_of_origin' => '7',
            'rescued_by' => '6',
            'rescued_from_address' => '5',
            'gd_number' => '4',
            'full_name' => '3',
            'id' => '1',
            /*'posts.title' => 2,
            'posts.body' => 1,*/
        ],
        /*'joins' => [
            'posts' => ['users.id','posts.user_id'],
        ],*/
    ];


    public static function boot()
    {
        parent::boot();
    }

    public function shelterHome()
    {
        return $this->belongsTo('App\ShelterHome');
    }

    public function carePlans()
    {
        return $this->belongsToMany('App\CarePlan')->withTimestamps();
    }

    public function created_by(){
        return $this->belongsTo('App\User');
    }


    public function attachments()
    {
        return $this->belongsToMany('App\Attachment')->withTimestamps();
    }

    /**
     * Get the addresses for the litigation.
     */
    public function addresses()
    {
        return $this->hasMany('App\Address');
    }

    /**
     * Get the family_members for the litigation.
     */
    public function family_members()
    {
        return $this->hasMany('App\FamilyMember');
    }

    /**
     * Get the children for the litigation.
     */
    public function children()
    {
        return $this->hasMany('App\Child');
    }


    public function district($did){
        //dd($did);
        $district = District::findOrFail($did);
       //dd($district);
        if(!empty($district)) {
        return $district->name;
        }
    }

    public function task($id)
    {
        $query = DB::table('tasks')
            ->where('id', $id)
            ->select('tasks.title')
            ->get();
        return $query[0]->title;
    }


    public static function updateCaseProfile($revisionable_type, $revisionable_id, $user_id, $key, $new_value)
    {

        // dd($key);
        $previous = DB::table('revisions')
            ->where('revisionable_id', $revisionable_id)
            ->where('revisionable_type', $revisionable_type)
            ->where('key', $key)
            ->take(1)
            ->orderBy('updated_at', 'desc')
            ->select('new_value')->get();

        //dd($old_value[0]->new_value);

        $old_value = (!empty($previous)) ? $previous[0]->new_value : '';
        // dd($old_value);
        DB::table('revisions')->insert([
            [
                'revisionable_type' => $revisionable_type,
                'revisionable_id' => $revisionable_id,
                'user_id' => $user_id,
                'key' => $key,
                'old_value' => $old_value,
                'new_value' => $new_value,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }

    public static function getCarePlanProgress($lid)
    {
        $care_plan_progresses = DB::table('care_plan_litigation')
            ->where('care_plan_litigation.litigation_id', $lid)
            ->leftjoin('care_plans', 'care_plans.id', '=', 'care_plan_litigation.care_plan_id')
            ->select('care_plans.title', 'care_plan_litigation.litigation_id', 'care_plan_litigation.status', 'care_plan_litigation.care_plan_id as id', 'care_plan_litigation.updated_at')
            ->orderBy('care_plan_litigation.updated_at', 'desc')
            ->get();

        return $care_plan_progresses;
    }

    public static function saveCarePlanStatus($litigation_id, $care_plan_id, $status)
    {
        DB::table('care_plan_litigation')
            ->where('litigation_id', $litigation_id)
            ->where('care_plan_id', $care_plan_id)
            ->update(array('status' => $status));
        $careplan = CarePlan::findOrFail($care_plan_id);
        self::updateCaseProfile('App\Litigation', $litigation_id, Auth::user()->id, 'Care Plan ' . $careplan->title, $status);

    }

    public static function initializeLitigationAccess($lid)
    {
        $litigation = Litigation::findOrFail($lid);
        $tasks = Task::all();
        $user = User::findOrFail(Auth::user()->id);
        $user_country = $user->country($user->id);
        $origin_country = $litigation->country_of_origin ? $litigation->country_of_origin : '1';
        //dd($origin_country);
        if($origin_country == $user_country) {
            $country_ids = array(
                $origin_country,
                $litigation->rescued_from_country ? $litigation->rescued_from_country : '2');
            //dd($country_ids);
            foreach ($tasks as $task) {
                self::storeCaseTaskStatus(1, $lid, $task->id, $country_ids, 0);
            }
        }
        else {
            foreach ($tasks as $task) {
                $country_ids = explode(',', $task->countries);
                self::storeCaseTaskStatus(1, $lid, $task->id, $country_ids, 0);
            }
        }

    }


    public static function storeCaseTaskStatus($status_id, $lid, $tid, $country_ids, $message_id)
    {
        //dd($status_id);

        if (!$country_ids) {
//            dd("aaaaaaaaaa");
            $countries = DB::table('litigation_task_task_status')
                ->where('litigation_id', $lid)
                ->where('task_id', $tid)
                ->select('assigned_country')->get();
            //dd($countries);
            $count = 0;
            foreach ($countries as $country) {
                $country_ids[$count] = $country->assigned_country;
                $count++;
            }
        }

        DB::table('litigation_task_task_status')
            ->where('litigation_id', $lid)
            ->where('task_id', $tid)
            ->delete();


        //dd($country_ids);

        foreach ($country_ids as $country_id) {
           // dd('ssss');
            DB::table('litigation_task_task_status')->insert(
                ['litigation_id' => $lid, 'task_id' => $tid,
                    'updated_by' => Auth::user()->id,
                    'task_status_id' => $status_id,
                    'assigned_country' => $country_id,
                    'message_id' => $message_id,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString()]
            );

        }

    }

    public function org($id){
        $org = DB::table('litigations')
            ->join('users', 'users.id', '=', 'litigations.created_by_id')
            ->join('organizations', 'organizations.id','=', 'users.organization_id')
            ->where('litigations.id', $id)
            ->get();
        return isset($org[0]) ? $org[0]->name : '';
    }

   public function country($cid){
       //dd($cid);
       $country = DB::table('countries')
           ->where('countries.id', $cid)
           ->get();

       return isset($country[0]) ? $country[0]->name : '';
   }

    public function verbalizeHistory($history)
    {

        $string = '';

        switch ($history->fieldName()) {
            /*case 'Age':
                $string = $history->userResponsible()->name.
            ' changed '.$history->fieldName().' from '.$history->old_value.' to '. $history->new_value;
                break;*/
            /* case 'Shelter Home':
                 echo "i equals 1";
                 break;*/
            /*case 2:
                echo "i equals 2";
                break;*/

            case 'Access Revoked':
                $string = $history->userResponsible()->organization()->get()[0]->name.
                    ' revoked access of '. $history->new_value;
                break;
            case 'Access Given':
                $string = $history->userResponsible()->organization()->get()[0]->name.
                    ' gave access to '. $history->new_value;
                break;

            default:
                $string =$history->userResponsible()->organization()->get()[0]->name . ' changed ' . $history->fieldName() . ' from '
                    . $history->old_value . ' to ' . $history->new_value;
                break;

        }

        return $string;
    }

    public static function getLitigationTaskStatus($litigation_id)
    {

    }

    public static function storeAssignmentInTaskStatus($status_id, $lid, $tid, $country_ids, $message_id)
    {
        self::storeCaseTaskStatus($status_id, $lid, $tid, $country_ids, $message_id);

    }

    public static function assignedLitigations()
    {
        //returns list of cases assigned to an Organization; Does not include the cases
        //assigned to other country with no users in the Organizations
        $items_per_page = Usability::$item_per_page;
        if (Auth::user()->organization_id > 1) {
            $litigations = DB::table('litigation_organization')
                ->join('litigations', 'litigation_organization.litigation_id', '=', 'litigations.id')
                ->leftJoin('districts', 'districts.id', '=', 'litigations.rescued_from_district')
                ->leftJoin('countries', 'countries.id', '=', 'litigations.rescued_from_country')
                ->where('litigation_organization.organization_id', Auth::user()->organization_id)
                ->select('litigations.*','districts.name as district_name','countries.name as country_name')
                ->paginate($items_per_page);
        } else {
            $litigations = DB::table('litigations')
                ->join('districts', 'districts.id', '=', 'litigations.rescued_from_district')
                ->join('countries', 'countries.id', '=', 'litigations.rescued_from_country')
                ->select('litigations.*','districts.name as district_name','countries.name as country_name')
                ->paginate($items_per_page);
        }

        //dd($litigations);
        return $litigations;
    }

    public function organizations()
    {
        return $this->belongsToMany('App\Organization');
    }

    public static function country_name($cid)
    {
        // dd(Countries::getCountryList()[$cid-1]['name']);
        $countries = Country::all();
       // dd($countries);
        foreach ($countries as $country) {
            if ($country['id'] == $cid) {
                return $country['name'];
            }
        }

    }

    public static function getCoupledCountry($user, $lid)
    {

        // Try..Catch block to to restrict user if the case doesn't exists.
        try {
            Litigation::findOrFail($lid);
        } catch (\Exception $e) {
            return redirect('/');
        }

        $query = DB::table('litigations')
            ->where('id', $lid)
            ->select('country_of_origin', 'rescued_from_country')
            ->get();

        $user_country = $user->organization()->get()[0]->country;
        $dst_country = $query[0]->rescued_from_country;
        $org_country = $query[0]->country_of_origin;
        //dd($org_country);

        $coupled_country = $org_country == $user_country ? $dst_country : $org_country;
        return $coupled_country;


    }

    public static function getAccessbileTasks($lid,$parent_task)
    {
        $user = Auth::user();
        $user_country = $user->organization()->get()[0]->country;
        $tasks = Litigation::getTasksForOrganization($user_country,Auth::user()->organization_id,$lid,$parent_task);

        //dd($tasks);
        return $tasks;
    }

    public static function getAssignedLitigationsWithTasks($organization_id,$status='open',$per_page=10,$country_of_origin)
    {
        $user = Auth::user();

        if ($user->hasRole(['owner', 'admin'])) {
            $litigations = Litigation::allLitigationsWithTasks($status,$per_page,$country_of_origin);
           // dd('aaaaa');
        }
        else {
            if($country_of_origin > 0) {
                $litigations = DB::table('litigations')
                    ->join('litigation_organization', 'litigation_organization.litigation_id', '=', 'litigations.id')
                    ->where('litigation_organization.organization_id', $organization_id)
                    ->where('litigations.status','=',$status)
                    ->where('litigations.country_of_origin','=',$country_of_origin)
                    ->distinct()->select('litigations.*')
                    ->orderBy('litigations.created_at','DESC')
                    ->paginate($per_page);
            }
            else {
                $litigations = DB::table('litigations')
                    ->join('litigation_organization', 'litigation_organization.litigation_id', '=', 'litigations.id')
                    ->where('litigation_organization.organization_id', $organization_id)
                    ->where('litigations.status','=',$status)
                    ->distinct()->select('litigations.*')
                    ->orderBy('litigations.created_at','DESC')
                    ->paginate($per_page);
            }
        }
        return $litigations;
    }

    public static function allLitigationsWithTasks($status='open',$per_page=10,$country_of_origin)
    {
        if($country_of_origin > 0) {
            $litigations = DB::table('litigations')
                ->where('litigations.status','=',$status)
                ->where('litigations.country_of_origin','=',$country_of_origin)
                ->select('litigations.*')
                ->orderBy('litigations.created_at','DESC')
                ->paginate($per_page);
        }
        else {
            $litigations = DB::table('litigations')
                ->where('litigations.status','=',$status)
                ->select('litigations.*')
                ->orderBy('litigations.created_at','DESC')
                ->paginate($per_page);
        }
        return $litigations;
    }

    public static function getTasksForOrganization($user_country,$user_organization_id,$litigation_id,$parent_id){
        //dd($parent_id);

        $user = Auth::user();

        /*if ($user->hasRole(['owner', 'admin'])) {
            $tasks = DB::table('tasks')
                ->join('litigation_task_task_status', 'tasks.id', '=', 'litigation_task_task_status.task_id')
                ->where('tasks.parent_id', $parent_id)
                ->where('litigation_task_task_status.litigation_id', $litigation_id)
                ->groupBy('tasks.id')
                ->orderBy('tasks.order', 'ASC')
                ->distinct()->select('tasks.*', 'litigation_task_task_status.task_status_id',
                    'litigation_task_task_status.assigned_country',
                    'litigation_task_task_status.created_at as updated_at',
                    'litigation_task_task_status.message_id as message_id',
                    'litigation_task_task_status.updated_by'
                )->get();
        }
        else {
        $tasks = DB::table('tasks')
            ->join('litigation_task_task_status', 'tasks.id', '=', 'litigation_task_task_status.task_id')
            ->join('litigation_organization', 'litigation_organization.litigation_id', '=', 'litigation_task_task_status.litigation_id')
            ->where('litigation_task_task_status.assigned_country', $user_country)
            ->where('litigation_organization.organization_id', $user_organization_id)
            ->where('litigation_organization.litigation_id', $litigation_id)
            ->where('tasks.parent_id', $parent_id)
            ->orderBy('tasks.order', 'ASC')
            ->distinct()->select('tasks.*', 'litigation_task_task_status.task_status_id',
                'litigation_task_task_status.assigned_country',
                'litigation_task_task_status.created_at as updated_at',
                'litigation_task_task_status.message_id as message_id',
                'litigation_task_task_status.updated_by'
            )->get();
       // dd($user_organization_id);
        }*/

        $tasks = DB::table('tasks')
            ->join('litigation_task_task_status', 'tasks.id', '=', 'litigation_task_task_status.task_id')
            ->where('tasks.parent_id', $parent_id)
            ->where('litigation_task_task_status.litigation_id', $litigation_id)
            ->groupBy('tasks.id')
            ->orderBy('tasks.order', 'ASC')
            ->distinct()->select('tasks.*', 'litigation_task_task_status.task_status_id',
                'litigation_task_task_status.assigned_country',
                'litigation_task_task_status.created_at as updated_at',
                'litigation_task_task_status.message_id as message_id',
                'litigation_task_task_status.updated_by'
            )->get();


        return $tasks;
    }

    public static function  getCaseInfoWithTasks($task,$id){

        $data = Litigation::findOrFail($id);
        $data['current_task_status'] = Litigation::getCurrentTaskStatus($task->id,$id);
        switch($task->id){
            case 1:
            case 2:
                //dd($data);
                break;
            case 3:
                $proceedings = Proceeding::where('litigation_id', $id)->get();

                $count=0;
               // $data['proceedings'][] =array();
                $proceeding_array = array();
                $attached_action_points = array();
                foreach($proceedings as $proceeding){
                    $proceeding->attached_action_points = Litigation::getActionPoint($proceeding->id);
                    $proceeding_array[] = $proceeding;
                }
                //dd($attached_action_points);
                $data['proceedings'] = $proceeding_array;
                $data['acts'] = Acts::getActList();
                $data['document_types'] = DocumentTypes::getDocumentTypes();
                $data['order_sources'] = OrderSources::getOrderSources();
                $data['action_points'] = Actpoint::all();
             // dd($data);
                break;
            case 4:
                $data['age'] = rand(15,20).' Years';
                $data['personal_info_addresses'] = Address::where('litigation_id', $id)->where('task_id', $task->id)->get();
                //dd($data);
                break;
            case 5:
                $movements = Movement::where('litigation_id', $id)->get();
                $data['movements'] = $movements;
                $data['destination_types'] = DestinationTypes::getDestTypes(); //todo add other destination types
                //dd($data['destination_types']);
                $data['shelter_homes']  = Organization::getCategorizedOrgs(2);
                $data['countries'] = Country::all();
                break;
            case 6:
                $case_studies = CaseStudy::where('litigation_id', $id)->get();
                $data['case_studies']  = $case_studies;
                break;
            case 7:
                $cares = Care::where('litigation_id', $id)->orderBy('service_id', 'ASC')->get();
                /*$cares = Care::join('services', 'cares.service_id', '=', 'services.id')->
                 where('litigation_id', $id)->orderBy('services.care_plan_id', 'DESC')->get();*/
                $data['cares']  = $cares;
                $data['treatment_types']  = TreatmentTypes::getTreatmentTypes();
                $data['care_plans']  = CarePlan::all();
                $data['service_types']  = Service::all();
                break;
            case 8:
                break;
            case 9:

                try {
                    $ngohir = Ngohir::where('litigation_id', $id)->firstOrFail();
                    $data['ngohir']  = $ngohir;
                    $data['ngohir_addresses'] = Address::getHierarchiedAddress($lid=$id,$tid=$task->id);
                    $files = Ngohirfile::where('litigation_id', $id)->orderBy('created_at', 'DESC')->get();
                    /*$cares = Care::join('services', 'cares.service_id', '=', 'services.id')->
                     where('litigation_id', $id)->orderBy('services.care_plan_id', 'DESC')->get();*/
                    $data['files']  = (!empty($files))?$files:array();

                    $data['care_plans']  = CarePlan::all();
                    $data['doc_types']  = DocType::all();
                } catch (\Exception $e) {
                    $files = Ngohirfile::where('litigation_id', $id)->orderBy('created_at', 'DESC')->get();
                    $data['files']  = (!empty($files))?$files:array();
                    $data['care_plans']  = CarePlan::all();
                    $data['doc_types']  = DocType::all();
                    $data['ngohir']  = [];
                }

                //dd($data['doc_types']);

//dd($data);
                break;
            case 10:
                //$data['forms']  = Form::where('task_id','=',10)->get();
                $data['forms']  = Litigation::getFormObjects(10,$id,$data->country_of_origin);
                //dd($data);
                break;
            case 11:
                $data['forms']  = Litigation::getFormObjects(11,$id,$data->country_of_origin);
                break;
            case 12:
                break;
            case 13:
                $data['forms']  = Litigation::getFormObjects(13,$id,$data->country_of_origin);
                break;
            case 14:
                $data['forms']  = Litigation::getFormObjects(14,$id,$data->country_of_origin);
                break;
            case 15:
                $data['forms']  = Litigation::getFormObjects(15,$id,$data->country_of_origin);
                break;
            case 16:
                $data['forms']  = Litigation::getFormObjects(16,$id,$data->country_of_origin);
                break;

            case 17:
                $data['forms']  = Litigation::getFormObjects(17,$id,$data->country_of_origin);
                break;

            case 18:
                $data['forms']  = Litigation::getFormObjects(18,$id,$data->country_of_origin);
                break;
            default:
                break;
        }

        /*$data['file']= strtolower(str_replace(".","",str_replace(" ", "-", $task->title)));
        $data['parent_id'] =$task->parent_id;
        $data['tid_id'] =$task->id;
        $data['type'] =$task->title;*/

        //dd($data);
        return $data;
    }

    public static function getAdditionalTasks($lid)
    {
        $user = Auth::user();
        $coupled_country = Litigation::getCoupledCountry($user, $lid);
        $users_under_coupled_country = User::getUsersInCoupledCountry($lid, $coupled_country);
        //dd($users_under_coupled_country);
        if (!$users_under_coupled_country) {
            $authorized_organizations = DB::table('litigation_organization')
                ->where('litigation_id', $lid)
                ->where('organization_id', '!=', Auth::user()->organization_id)
                ->select('organization_id')
                ->get();

            if (!empty($authorized_organizations)) {
                $additional_tasks = Litigation::getTasksForOrganization($coupled_country, $authorized_organizations[0]->organization_id, $lid,0);
            }
        }

        return (!empty($additional_tasks)) ? $additional_tasks : array();
    }

    public static function getFormObjects($id,$lid,$country_of_origin){
        //todo refactor the query with joining

        $objects = DB::table('forms')
            ->where('forms.task_id', $id)
            ->where('forms.country_id', $country_of_origin)
            ->orderBy('order', 'asc')
            ->get();
       //dd($objects);
       $forms = array();
        $count=0;
        foreach($objects as $object){
            if($object->generic==1) {
                Form::getGenericFields($lid,$object,$count);
            }
            else {
                Form::getCustomFields($lid,$object,$count);
                Form::getGenericFields($lid,$object,$count);
            }
            $count++;
        }

        //dd($objects);
        return $objects;
    }

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameDuringRescueAttribute($value)
    {
        return ucwords($value);
    }

    public static function getActionPoint($pid){
        $proceeding = Proceeding::findOrFail($pid);
        $action_points = array();
        $count = 0;
        foreach ($proceeding->actpoints()->get() as $action_point) {
            $action_points[$count]['id'] = $action_point->id;
            $action_points[$count]['title'] = $action_point->title;
            $count++;
        }
//dd($action_points);
        return $action_points;
    }

    public static function getCapabilityToSaveTask($lid, $tid){
        $tasks = Litigation::getAccessbileTasks($lid,0);
       // dd($tasks);

        $role = Auth::user()->roles[0]->name;

        $capable = false;
        if($role=='owner'){
            $capable = true;
        }
        elseif ($role=='admin') {
            $capable = false;
        }
        else {
            foreach ($tasks as $task) {
                if ($task->id == $tid) {
                    $capable = true;
                    break;
                }
            }

            if (!$capable) {
                $additional_tasks = Litigation::getAdditionalTasks($lid);
                foreach ($additional_tasks as $task) {
                    if ($task->id == $tid) {
                        $capable = true;
                        break;
                    }
                }
            }
        }

        return $capable;
    }

    public static function saveCaseTask($status_id,$lid, $tid){
        //dd('$status_id'.$status_id.',$lid'.$lid.', $tid'.$tid);
       // dd(Auth::user()->organization()->get()[0]->name);
        Litigation::storeCaseTaskStatus($status_id, $lid, $tid, array(), $message_id = 0);
        $litigation = Litigation::findOrFail($lid);
        $task = Task::findOrFail($tid);
        $task_status = TaskStatus::findOrFail($status_id);
        Litigation::updateCaseProfile('App\Litigation', $lid, Auth::user()->id, 'Task Status', $task_status->name . ' for task ' . $task->title);
        $notifiables = Organization::notifiableOrgs($lid,$tid);
        $subject = Auth::user()->organization()->get()[0]->name." has changed the task status of <strong>".$task->title."</strong> to <strong>".$task_status->name."</strong> of case ID <strong>".$litigation->case_id.'</strong>';
        $url = '/cases/'.$lid.'?tid='.$tid;
       // dd($subject);





        Message::sendNotification($key='task_status',$subject,$url,$lid,$notifiables);
    }

    public static function getCurrentTaskStatus($tid,$lid){
        $task_status = DB::table('litigation_task_task_status')
        ->join('task_statuses','id','=','litigation_task_task_status.task_status_id')
            ->where('litigation_id', $lid)
            ->where('task_id', $tid)->get();
        //dd($task_status);
        return str_replace(".","",str_replace(" ", "-", $task_status[0]->name));
    }
}
