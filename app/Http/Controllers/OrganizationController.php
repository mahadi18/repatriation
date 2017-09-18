<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\OrganizationRequest;
use App\Http\Controllers\Controller;

use App\Litigation;
use App\Organization;
use App\Task;
use App\TaskStatus;
#use Codesleeve\Stapler\Attachment;
use Illuminate\Http\Request;
use App\Classes\Countries;
use App\Classes\Organizations;
use App\Classes\Usability;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Country;
use App\State;
use App\District;
use App\Attachment;

class OrganizationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('org.editable', ['only' => ['edit', 'store', 'destroy']]);
    }

    public function dashboard(Request $request, $oid = 0)
    {

        //dd($request['filter']);
        $logged_organization = Organization::getLoggedOrganization();
        $organization = Organization::findOrFail($logged_organization);
        //dd($organization->country);

        $status = isset($request['status']) ? $request['status'] : 'open';
        $items_per_page = isset($request['items_per_page']) ? $request['items_per_page'] : 10;

        if(Auth::user()->roles[0]->name=='owner' ||Auth::user()->roles[0]->name=='admin' || get_organization_country(Auth::user()->organization_id)==2) {

            $country_of_origin = isset($request['country_of_origin']) ? $request['country_of_origin'] : 0;
        } else {
            $country_of_origin = 0;
        }

        $litigations = Litigation::getAssignedLitigationsWithTasks($logged_organization, $status, $items_per_page, $country_of_origin);
        //echo count($litigations);
//dd($litigations);
        foreach ($litigations as $litigation) {

            $litigation->tasks = Litigation::getTasksForOrganization($organization->country, $logged_organization, $litigation->id, 0);
            $litigation->continious_tasks = Litigation::getAccessbileTasks($litigation->id, 1);
//            $litigation->victim_pic = Attachment::getAttachemntForLitigation($litigation->id);
            $litigation->victim_pic = (!empty(get_victim_attachment('Victim Personal Image', $litigation->id)['file_path'])) ? get_victim_attachment('Victim Personal Image', $litigation->id)['file_path'] : '/uploads/-text.png';
            $litigation->country = Country::getCountryNameFromID($litigation->nationality);
            //dd($litigation->country);
            //$litigation->country_name = Litigation::country_name($litigation->country_of_origin);

            //dd($litigation->tasks);
            foreach ($litigation->tasks as $task) {
                $task_status = TaskStatus::findOrFail($task->task_status_id);
                $task->status = $task_status->name;
                $task->url = Task::getURLfromTaskID($task->id);
                $user = User::findOrFail($task->updated_by);
                $task->updator_organization = $user->organization()->get()[0]->name;
            }


        }
        //dd($litigations);
        return view('organizations.dashboard', compact('litigations', 'status', 'items_per_page', 'country_of_origin'));
    }


    public function index()
    {
        $items_per_page = Usability::$item_per_page;
        $country_id = \Input::get('country-id');
        if (isset($country_id) && $country_id != '') {
            $organizations = Organization::where('id', '>', 1)->where('organizations.country', '=', $country_id)->paginate(25);
        } else {
            $organizations = Organization::where('id', '>', 1)->paginate(25);
        }

        //dd($organizations);
        return view('organizations.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $countries = Country::all();
        $states = State::where('country_id', 1)->get();
        //dd($states[0]->id);
        $districts = District::where('state_id', $states[0]->id)->get();
        //dd($countries);
        $org_types = Organizations::getOrgList();
        return view('organizations.create', compact('countries', 'states', 'districts', 'org_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(OrganizationRequest $request)
    {
        $organization = new Organization();

        $organization->name = $request->input("name");
        $organization->description = $request->input("description");
        $organization->address = $request->input("address");
        $organization->country = $request->input("country");
        $organization->org_type = $request->input("organization_type");
        $organization->contact_designation = $request->input("contact_designation");
        $organization->contact_person = $request->input("contact_person");
        $organization->email = $request->input("email");
        $organization->phone = $request->input("phone");
        $organization->district_id = $request->input("district");

        $organization->save();

        return redirect()->route('organizations.index')->with('message', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $organization = Organization::findOrFail($id);
        $organizations = Organization::where('parent_id', '=', $id)->paginate(25);
        //dd($organizations);
        return view('organizations.show', compact('organization', 'organizations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $organization = Organization::findOrFail($id);
        $org_types = Organizations::getOrgList();

        return view('organizations.edit_org_select', compact('organization', 'org_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Request $request
     * @return Response
     */
    public function update(OrganizationRequest $request, $id)
    {
        $organization = Organization::findOrFail($id);

        $organization->name = $request->input("name");
        $organization->org_type = $request->input("organization_type");
        $organization->address = $request->input("address");
        $organization->country = $request->input("organization_country");
        $organization->district_id = $request->input("organization_district");
        $organization->phone = $request->input("phone");
        $organization->email = $request->input("email");
        $organization->contact_person = $request->input("contact_person");
        $organization->contact_designation = $request->input("contact_designation");
        $organization->description = $request->input("description");

        $organization->save();

        return redirect()->route('organizations.show', $id)->with('message', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $organization = Organization::findOrFail($id);
        $organization->delete();

        return redirect()->route('organizations.index')->with('message', 'Item deleted successfully.');
    }


    public function getOrgsOfType($id)
    {
        $orgs = Organization::where('org_type', $id)->get();
        return $orgs;
    }

    public function getOrgsInfo($id)
    {
        $org = Organization::findOrFail($id);
        $org->district = District::findOrFail($org->district_id)->name;
        $org->state = District::findOrFail($org->district_id)->state()->get()[0]->name;
        $org->country = District::findOrFail($org->district_id)->state()->get()[0]->country()->get()[0]->name;
        return $org;
    }

}
