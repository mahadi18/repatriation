<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Organization;
use App\Litigation;
use App\Country;
use App\State;
use App\Dashboard;
use Illuminate\Support\Facades\Auth;
use Input;
use Response;
use Symfony\Component\HttpKernel\HttpCache\Ssi;
//use Yajra\Datatables\Facades\Datatables;
use Yajra\Datatables\Datatables;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('org.editable', ['only' => ['edit', 'store', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *git
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $casesWithOutNgoHirs = Dashboard::getCasesWithoutNgoHirs();
        $totalCasesWithoutNgoHirs = Dashboard::countCasesWithoutNgoHirs();
        $toalCasesWithNgoHirsButOpened = Dashboard::countCasesWithNgoHirsButOpened();
        $casesWithNgoHirsButOpened = Dashboard::getCasesWithNgoHirsButOpened();
        $litigationWithTimeDuration = Dashboard::getLitigationWithTimeDurationForClosedCases();
        $taskMatrix = $this->showAchievableTaskMatrix();



        $totalOrganizationsByCountry = Dashboard::countOrganizationsByCountry();
        if ((auth()->user()->roles[0]->name != 'owner' || auth()->user()->roles[0]->name != 'admin')) {
            $litigationsWithIncompleteStateHir = Dashboard::getLitigationWithIncompleteStateHir();
            $totalCasesWithoutStateHir = Dashboard::countCasesWithoutStateHIR();
            return view('dashboard.admin.index',
                compact(
                    'casesWithOutNgoHirs',
                    'totalCasesWithoutNgoHirs',
                    'toalCasesWithNgoHirsButOpened',
                    'casesWithNgoHirsButOpened',
                    'litigationWithTimeDuration',
                    'totalOrganizationsByCountry',
                    'taskMatrix',
                    'litigationsWithIncompleteStateHir',
                    'totalCasesWithoutStateHir'
                )
            );
        }
        if (auth()->user()->roles[0]->name == 'contributor') {
            $logged_organization = Organization::getLoggedOrganization();
           $litigationsWithIncompleteStateHir = Dashboard::getLitigationWithIncompleteStateHir($logged_organization);
            $totalCasesWithoutStateHir = Dashboard::countCasesWithoutStateHIR($logged_organization);
            return view('dashboard.organization.index',
                compact(
                    'casesWithOutNgoHirs',
                    'totalCasesWithoutNgoHirs',
                    'toalCasesWithNgoHirsButOpened',
                    'casesWithNgoHirsButOpened',
                    'litigationWithTimeDuration',
                    'totalOrganizationsByCountry',
                    'taskMatrix',
                    'litigationsWithIncompleteStateHir',
                    'totalCasesWithoutStateHir'
                )
            );
        }
    }

    public function demo()
    {
//        return Dashboard::getYearWiseRepatriation();
        return Dashboard::getCasesWithoutNgoHirs();;
    }

    public function setCoordinatesForState()
    {
        $states = State::all();
        return response($states);
    }

    public function testOld()
    {
        $rescues = Dashboard::getNumberOfRescuesByState();
//        dd($rescues);
        return view('dashboard.table');
    }

    public function test()
    {
        $data = [
            'totalUsers' => User::countUsers(),
            'totalOrganizationsByCountry' => User::countOrganizationsByCountry(),
            'litigationsByOrganization' => Organization::countLitigationByOrganization()
        ];
        return view('dashboard.table')->with($data);;
    }

    public function showNumberOfRescuesByState()
    {
        $rescues = Dashboard::getNumberOfRescuesByState();
        return response($rescues);
    }

    public function showInitialCasesByCountry()
    {
        $initatedCasesByCountry = Dashboard::getInitiatedCasesByCountry();
        return Response::json($initatedCasesByCountry);
    }

    public function showInitiatedCasesBetweenDates()
    {
        $dateFrom = Carbon::parse(Input::get('dateFrom'))->format('Y-m-d');
        $dateTo = Carbon::parse(Input::get('dateTo'))->format('Y-m-d');
        $initiatedCases = Dashboard::getInitiatedCasesBetween($dateFrom, $dateTo);
        return Response::json($initiatedCases);
    }

    /**active route
     * @return Response
     */
    public function showInitiatedCases()
    {
        $country = [];
        foreach (Country::all() as $key => $item) {
            $country[$item->name] = [
                'country_id' => $item->id,
                'latitude' => $item->latitude,
                'longitude' => $item->longitude,
                'totalCases' => Dashboard::getInitiatedCasesWithStatus($item->id),
                'open' => Dashboard::getInitiatedCasesWithStatus($item->id, 'open'),
                'closed' => Dashboard::getInitiatedCasesWithStatus($item->id, 'closed')
            ];
        }

        return response($country);
    }

    public function showTotalOrganizationsByCountry()
    {
        $totalOrganizations = Dashboard::getNumberOfOrganizationByCountry();
        return $totalOrganizations;
    }

    public function showNumberOfRescuesByAge()
    {
        $ageGroup = [];
//        foreach (Dashboard::getCountryOfOrigin() as $country) {
//            $ageGroup[$country->country] = $this->groupTotalRescuesByAge($country->country_id);
//        }
        foreach (Dashboard::getCountryOfOrigin() as $country) {
//            $ageGroup[$country->country] = $this->groupTotalRescuesByAge($country->country_id);
//            $ageGroup[$country->country] = $this->getSumation($this->groupTotalRescuesByAge($country->country_id));
            $ageGroup[$country->country] = $this->groupTotalRescuesByAge($country->country_id);
        }
//        $this->addTotal($ageGroup);
        return $ageGroup;
    }

    public function showNumberOfRepatriationByAge()
    {
        $ageGroup = [];
//        foreach (Dashboard::getCountryOfOrigin() as $country) {
//            $ageGroup[$country->country] = $this->groupTotalRescuesByAge($country->country_id);
//        }
        foreach (Dashboard::getCountryOfOrigin() as $country) {
//            $ageGroup[$country->country] = $this->groupTotalRescuesByAge($country->country_id);
//            $ageGroup[$country->country] = $this->getSumation($this->groupTotalRescuesByAge($country->country_id));
            $ageGroup[$country->country] = $this->groupTotalRescuesByAge($country->country_id, 'closed');
        }
//        $this->addTotal($ageGroup);
        return $ageGroup;
    }

    public function getSumation($data)
    {
        $total = 0;
        foreach ($data as $key => $item) {
            $total += $item;
        }
        $data['total'] = $total;
//        array_push($data, $total);
        return $data;
    }

//    public function addTotal(&$arr)
//    {
//        $ageGroup = [];
//        foreach (Dashboard::getCountryOfOrigin() as $country) {
//            $ageGroup[$country->country] = $this->groupTotalRescuesByAge($country->country_id);
//        }
//
////        $this->addTotal($ageGroup);
//        return $ageGroup;
//    }

    private function groupTotalRescuesByAge($country = 1, $status = '')
    {
        $underTwelve = '';
        $twelveTo18 = '';
        $eighteenTo25 = '';
        $above25 = '';
        $ageGroup = [];
        $data = Dashboard::countRescuesByAge($country);
        if ($status) {
            $data = Dashboard::countRescuesByAge($country, $status);
        }
        foreach ($data as $row) {
            if (intval($row->age) < 12) {
                $underTwelve += $row->totalRescues;
                $ageGroup["< 12"] = $underTwelve;
            }
            if ((intval($row->age) >= 12) && (intval($row->age) < 18)) {
                $twelveTo18 += $row->totalRescues;
                $ageGroup['12-18'] = $twelveTo18;
            }
            if ((intval($row->age) >= 18) && (intval($row->age) < 25)) {
                $eighteenTo25 += $row->totalRescues;
                $ageGroup['18-25'] = $eighteenTo25;
            }
            if ((intval($row->age) >= 25)) {
                $above25 += $row->totalRescues;
                $ageGroup['> 25'] = $above25;
            }
        }
        return $ageGroup;
    }

    public function showNumberOfRescuesByGender()
    {
        $json = [];
        $maleFemaleRescues = [];
        $totalrescue = [];
        foreach (Dashboard::getCountryOfOrigin() as $country) {
            if($country->country == 'Bangladesh'){
                $countryName = 'Bangladeshi';
            } else{
                $countryName = 'Nepalese';
            }
            $maleFemaleRescues[$countryName] = [
                'male' => Dashboard::countMaleRescuedOfACountry($country->country_id),
                'female' => Dashboard::countFemaleRescuedOfACountry($country->country_id),

            ];
            /*$totalrescue[$country->country]=[
                'total'=> Dashboard::countTotaleRescuedOfACountry($country->country_id)
            ];*/
        }
        $maleFemaleRescues['Total'] = [
            'male' => Dashboard::countMaleRescuedOfACountry(1) + Dashboard::countMaleRescuedOfACountry(3),
            'female' => Dashboard::countFemaleRescuedOfACountry(1) + Dashboard::countFemaleRescuedOfACountry(3)
        ];
//        array_push($json, $maleFemaleRescues);
//        array_push($json, $totalrescue);
        return $maleFemaleRescues;
//        return Dashboard::countTotaleRescuedOfACountry(1);
    }

    public function showNumberOfRepatriationByGender()
    {
        $json = [];
        $maleFemaleRescues = [];
        $totalrescue = [];
        foreach (Dashboard::getCountryOfOrigin() as $country) {
            if($country->country == 'Bangladesh'){
                $countryName = 'Bangladeshi';
            } else{
                $countryName = 'Nepalese';
            }
            $maleFemaleRescues[$countryName] = [
                'male' => Dashboard::countRepatriatedMaleByCountry($country->country_id),
                'female' => Dashboard::countRepatriatedFemaleByCountry($country->country_id),

            ];
            /*$totalrescue[$country->country]=[
                'total'=> Dashboard::countTotaleRescuedOfACountry($country->country_id)
            ];*/
        }
        $maleFemaleRescues['Total'] = [
            'male' => Dashboard::countRepatriatedMaleByCountry(1) + Dashboard::countRepatriatedMaleByCountry(3),
            'female' => Dashboard::countRepatriatedFemaleByCountry(1) + Dashboard::countRepatriatedFemaleByCountry(3)
        ];
//        array_push($json, $maleFemaleRescues);
//        array_push($json, $totalrescue);
        return $maleFemaleRescues;
//        return Dashboard::countTotaleRescuedOfACountry(1);
    }

    public function showTotalInitiationByOrganization()
    {
        $countryName = Input::get('country');
        return Dashboard::countLitigationsOfAnOrganizationByCountry($countryName);
    }

    public function showLitigationsWithIncompleteStateHir()
    {
        $litigations = Dashboard::getLitigationWithIncompleteStateHir(18);
        return $litigations;
    }

    public function showNgoHrCompletedOrganizationByCountry($cId = 0, $oId = 0)
    {
        if ($cId != 0 && $oId != 0) {
            $organizations = Dashboard::completedNgoHrWithTimeDurationByCountry($cId, $oId);
        } else {
            $countryId = Input::get('country_id');
            $organizations = Dashboard::completedNgoHrWithTimeDurationByCountry($countryId);
        }
        $customArray = [];
        foreach ($organizations as $key => $org) {
            $customArray[$key] = [
                'status' => $org->status,
                'name' => $org->name,
                'totalNgoHr' => $org->totalNgoHr,
                'nationality' => $org->nationality,
                'mintime' => $this->calculateDayMonthYearFromDays($org->mintime),
                'maxtime' => $this->calculateDayMonthYearFromDays($org->maxtime),
                'avgtime' => $this->calculateDayMonthYearFromDays($org->avgtime)
            ];
        }
        return $customArray;
    }

    private function calculateDayMonthYearFromDays($days = 0)
    {
        $vmonths = '';
        $vdays = '';
        $vyears = '';
        if ($days == 0 || $days < 1) {
            return 0 . ' day';
        }
        if ($days / 30 >= 1) {
            $vmonths = floor($days / 30);
            $vdays = floor($days % 30);
            if ($vmonths / 12 > 1) {
                $vyears = floor($vmonths / 12);
                $vmonths = floor($vmonths % 12);
            } else {
                $vyears = floor($vmonths / 12);
                $vmonths = floor($vmonths % 12);
            }
        } else {
            $vdays = floor($days % 30);
        }
        return $this->mergeYearMonthDay($vyears, ' year') . ' '
        . $this->mergeYearMonthDay($vmonths, ' month') . ' '
        . $this->mergeYearMonthDay($vdays, ' day');
    }

    private function mergeYearMonthDay($value, $text)
    {
        if ($value == 0) {
            $value = '';
        } else if ($value > 1) {
            $value = $value . $text . 's';
        } else {
            $value = $value . $text;
        }
        return $value;
    }

    public function showAchievableTaskMatrix()
    {
        $taskMatrix = Dashboard::getAchievableTaskMatrixWithTimeDuration();
        $modifiedTaskMatrix = [];
        foreach ($taskMatrix as $key => $task) {
            $modifiedTaskMatrix[$key] = [
                'task' => $task->task,
                'totalTasks' => $task->totalTasks,
                'mintime' => $this->calculateDayMonthYearFromDays($task->mintime),
                'maxtime' => $this->calculateDayMonthYearFromDays($task->maxtime),
                'avgtime' => $this->calculateDayMonthYearFromDays($task->avgtime),
            ];
        }
        return $modifiedTaskMatrix;
    }

    public function showStateWiseRepatriation()
    {
        $countryId = Input::get('country_id');
        $rescued = [];

        foreach (Dashboard::getStateWiseRepatriation($countryId, 'closed') as $key => $rescue) {
            $rescued[$key] = [
                'rescues' => intval($rescue->rescues),
                'state' => $rescue->state,
                'nationality' => $rescue->nationality,
                'countryOfOrigin' => $rescue->countryOfOrigin,

            ];
        }
        return ($rescued);
    }

    public function showStateWiseRescues()
    {
        $countryId = Input::get('country_id');
//        $rescued = Dashboard::getStateWiseRepatriation($countryId);
        $rescued = [];

        foreach (Dashboard::getStateWiseRepatriation($countryId) as $key => $rescue) {
            $rescued[$key] = [
                'rescues' => intval($rescue->rescues),
                'state' => $rescue->state,
                'nationality' => $rescue->nationality,
                'countryOfOrigin' => $rescue->countryOfOrigin,

            ];
        }
        return ($rescued);
    }

    public function showYearWiseRescues()
    {
        $recues = [];
        foreach (Dashboard::getRescuesByYear() as $key => $value) {
            $bd = $value->bd != null ? $value->bd : 0;
            $nepal = $value->nepal != null ? $value->nepal : 0;
            $recues[$key] = [
                'year' => $value->year,
                'bd' => intval($bd), //todo check type casting problem
                'nepal' => intval($nepal),
                'total' => $bd + $nepal
            ];
        }
        return $recues;
    }

    public function showYearWiseRepatriation()
    {
        $repatriation = [];
        foreach (Dashboard::getRepatirationsByYear() as $key => $value) {
            $bd = $value->bd != null ? $value->bd : 0;
            $nepal = $value->nepal != null ? $value->nepal : 0;
            $repatriation[$key] = [
                'year' => $value->year,
                'bd' => intval($bd),
                'nepal' => intval($nepal),//todo check type casting problem
                'total' => $bd + $nepal
            ];
        }
        return $repatriation;
    }
}
