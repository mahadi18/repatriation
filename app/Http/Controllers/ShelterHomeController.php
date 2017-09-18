<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ShelterHomeRequest;
use App\Http\Controllers\Controller;
use App\Classes\Countries;
use App\Classes\Usability;

use App\ShelterHome;
use App\CarePlan;
use Illuminate\Http\Request;

class ShelterHomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items_per_page = Usability::$item_per_page;
        $shelterhomes = ShelterHome::paginate($items_per_page);

        return view('shelterhomes.index', compact('shelterhomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        /*$SelectedCountries = Countries::getCountryList();
        $shelterHomeServices = Usability::getShelterHomeServices();
        $care_plans = CarePlan::all();

        foreach ($shelterHomeServices as $shelterHomeService) {
            $services[$shelterHomeService['id']] = $shelterHomeService['name'];
        }

        foreach ($SelectedCountries as $SelectedCountry) {
            $countries[$SelectedCountry['id']] = $SelectedCountry['name'];
        }

        foreach ($care_plans as $care_plan) {
            $cps[$care_plan['id']] = $care_plan['title'];
        }

        return view('shelterhomes.create', compact('countries', 'services', 'cps'));*/
        return view('shelterhomes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(ShelterHomeRequest $request)
    {
        $shelterhome = new ShelterHome();

        $shelterhome->name                      = $request->input("shelterhome_name");
        $shelterhome->address                   = $request->input("shelterhome_address");
        $shelterhome->country                   = $request->input("shelterhome_country");
        $shelterhome->district_id               = $request->input("shelterhome_district");
        $shelterhome->phone                     = $request->input("contact_number");
        $shelterhome->email                     = $request->input("email");
        $shelterhome->contact_person            = $request->input("contact_person");
        $shelterhome->contact_designation       = $request->input("designation");
        $shelterhome->description               = $request->input("description");
        $shelterhome->org_type                  = "2"; // Organization Type id 2 is for Shelter Home
        $shelterhome->parent_id                 = auth()->user()->organization_id;

        $shelterhome->save();

        return redirect()->route('organizations.show', auth()->user()->organization_id)->with('message', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $shelterhome = ShelterHome::findOrFail($id);

        return view('shelterhomes.show', compact('shelterhome'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $shelterhome = ShelterHome::findOrFail($id);

        $SelectedCountries = Countries::getCountryList();
        $shelterHomeServices = Usability::getShelterHomeServices();
        $care_plans = CarePlan::all();

        foreach ($shelterHomeServices as $shelterHomeService) {
            $services[$shelterHomeService['id']] = $shelterHomeService['name'];
        }

        foreach ($SelectedCountries as $SelectedCountry) {
            $countries[$SelectedCountry['id']] = $SelectedCountry['name'];
        }

        foreach ($care_plans as $care_plan) {
            $cps[$care_plan['id']] = $care_plan['title'];
        }

        return view('shelterhomes.edit', compact('shelterhome', 'services', 'countries', 'cps'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Request $request
     * @return Response
     */
    public function update(ShelterHomeRequest $request, $id)
    {
        $shelterhome = ShelterHome::findOrFail($id);

        $shelterhome->name                      = $request->input("shelterhome_name");
        $shelterhome->address                   = $request->input("shelterhome_address");
        $shelterhome->country                   = $request->input("shelterhome_country");
        $shelterhome->district_id               = $request->input("shelterhome_district");
        $shelterhome->phone                     = $request->input("contact_number");
        $shelterhome->email                     = $request->input("email");
        $shelterhome->contact_person            = $request->input("contact_person");
        $shelterhome->contact_designation       = $request->input("designation");
        $shelterhome->description               = $request->input("description");
        // $shelterhome->org_type                  = "2"; // Organization Type id 2 is for Shelter Home
        // $shelterhome->parent_id                 = auth()->user()->organization_id;

        $shelterhome->save();

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
        $shelterhome = ShelterHome::findOrFail($id);
        $shelterhome->delete();

        return redirect()->route('shelterhomes.index')->with('message', 'Item deleted successfully.');
    }

    public function intake($id)
    {
        $shelterhome = ShelterHome::findOrFail($id);

        return view('shelterhomes.intake', compact('shelterhome'));
    }

    public function carePlansWithCases($id){
        $shelter_home_care_litigations = ShelterHome::getShelterhomeCarePlanLitigation($id);
        //dd($shelter_home_care_litigations);
        return view('organizations.care_plans_cases', compact('shelter_home_care_litigations'));
    }

}
