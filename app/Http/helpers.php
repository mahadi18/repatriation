<?php

use App\Litigation;

if (!function_exists('inspiring_quote')) {

    /**
     * Test helper function to represent the usage
     */
    function inspiring_quote()
    {
        return Inspiring::quote();
    }

}

if (!function_exists('initial_notifications')) {

    /**
     * Helper function to represent initial notifications
     */
    function initial_notifications()
    {
        $notifications = \App\Message::getNgoNotifications();
        return $notifications;
    }

}

if (!function_exists('initial_messages')) {

    /**
     * Helper function to represent initial notifications
     */
    function initial_messages()
    {
        $messages = \App\Message::getNgoMessages();
        return $messages;
    }

}


if (!function_exists('LeftNavigation')) {

    /**
     * User left Navigation Loader
     */
    function left_navigation()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        // dd($user->roles[0]->name);
        $options = '';

        switch ($user->roles[0]->name) {
            case 'contributor':
                $options = contributorLeftNav();
                break;

            case 'owner':
                $options = ownerLeftNav();
                break;

            case 'admin':
                $options = ownerLeftNav();
                break;
        }
        echo $options;
    }


    function ownerLeftNav()
    {
        /* Ripon change it from  "/organization/dashboard" */
        return '<ul class="sidebar-menu" id="nav-accordion">

                <li><a href="/dashboard">Dashboard</a></li> 
                <li class="sub-menu">
                    <a href="javascript:;">
                        <span>Action Points</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/actpoints/create">Create</a></li>
                        <li><a href="/actpoints">List</a></li>
                    </ul>
                </li>
                <!--<li class="sub-menu">
                    <a href="javascript:;">
                        <span>Tasks</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/tasks/create">Create</a></li>
                        <li><a href="/tasks">List</a></li>
                    </ul>
                </li>-->
                <li class="sub-menu">
                    <a href="javascript:;">
                        <span>Cases</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/cases/create">Intake</a></li>
                        <li><a href="/cases">List</a></li>

                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <span>NGOs</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/organizations/create">Create</a></li>
                        <li><a href="/organizations">List</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <span>Users</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/users/create">Create</a></li>
                        <li><a href="/users">List</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <span>Care Types</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/careplans/create">Create</a></li>
                        <li><a href="/careplans">List</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <span>Service Types</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/services/create">Create</a></li>
                        <li><a href="/services">List</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <span>Doc Types</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/doctypes/create">Create</a></li>
                        <li><a href="/doctypes">List</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <span>Forms</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/forms/create">Create</a></li>
                        <li><a href="/forms">List</a></li>

                    </ul>
                </li>
                <li class="sub-menu">
                            <a href="javascript:;">
                                <span>Form Fields</span>
                            </a>
                            <ul class="sub">
                                <li><a href="/form_fields/create">Create</a></li>
                                <li><a href="/form_fields">List</a></li>
                            </ul>
                        </li>
            </ul>';
    }


    function contributorLeftNav()
    {
        return '<ul class="sidebar-menu" id="nav-accordion">
                <li><a href="/organization/dashboard">Dashboard</a></li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <span>Cases</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/cases/create">Intake</a></li>
                        <li><a href="/cases">List</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <span>NGOs</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/organizations">List</a></li>
                    </ul>
                </li>

            </ul>';
    }
}

if (!function_exists('header_link')) {

    /**
     * Helper function to get list of organizations
     */
    function header_link()
    {
        
        /* Ripon add inline css in <a> tag */
        
        $user = \Illuminate\Support\Facades\Auth::user();
        switch ($user->roles[0]->name) {
            case 'contributor':
                $link = '';
                //$link = '<a href="/cases/create"><i class="fa fa-plus"></i>Create an Intake</a>';
                break;

            case 'owner':
                $link = '<a style="font-size:12px; background-color:#E9FFFA; padding:9px 4px !important; border-radius:4;color:#1E9D8A; border:1px solid #1E9D8A;" href="/organizations"><i class="fa fa-cog"></i> Administration</a>';
                break;

            case 'admin':
                $link = '<a style="font-size:12px; background-color:#E9FFFA; padding:9px 4px !important; border-radius:4;color:#1E9D8A; border:1px solid #1E9D8A;" href="/organizations"><i class="fa fa-cog"></i> Administration</a>';
                break;
        }
        echo $link;
        //return '<a href="/cases/create"><i class="fa fa-plus"></i> Create an Inake</a>';
    }

}

if (!function_exists('get_organizations_list')) {

    /**
     * Helper function to get list of organizations
     */
    function get_organizations_list()
    {
        return \App\Organization::where('id', '>', 1)->lists('name', 'id')->all();

    }

}

if (!function_exists('get_dynamic_field')) {

    /**
     * Helper function to get list of organizations
     */
    function get_dynamic_field($id, $type, $value)
    {
        switch ($type) {
            case 'text':
                $field = '<input type="text" name="field-' . $id . '" value="' . $value . '" class="form-control">';
                break;

            case 'date':
                $field = '<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="' . date('d-m-Y') . '"  class="input-append date dpYears">
                                            <input readonly="readonly"  name="field-' . $id . '" type="text" value="' . $value . '" size="16" class="form-control">
                                              <span class="input-group-btn add-on">
                                                <button class="btn btn-success" type="button"><i class="fa fa-calendar-plus-o"></i></button>
                                              </span>
                                        </div>';
                break;

            case 'rte':
                $field = '<textarea type="text" name="field-' . $id . '" class="form-control ckeditor">' . $value . '</textarea>';
                break;
        }
        echo $field;

    }

}

if (!function_exists('get_countries_list')) {

    /**
     * Helper function to get list of countries
     */
    function get_countries_list()
    {
        return \App\Country::lists('name', 'id')->all();
    }

}

if (!function_exists('get_countries_list_except_india')) {

    /**
     * Helper function to get list of countries except india
     */
    function get_countries_list_except_india()
    {

        $countries = \App\Country::whereNotIn('name', ['India'])->lists('name', 'id')->all();
        $countries[0] = "Please Select";
        ksort($countries);
        return ($countries);
    }

}

if (!function_exists('states_of_country')) {

    /**
     * Helper function to get list of countries except india
     */
    function states_of_country($country_id)
    {
        $states[0] = "Please Select";
        $states = \App\State::where('country_id', $country_id)->lists('name', 'id')->all();
        ksort($states);
        return ($states);

    }

}

if (!function_exists('district_of_state')) {

    /**
     * Helper function to get list of countries except india
     */
    function district_of_state($state_id)
    {
        $districts[0] = "Please Select";
        $districts = \App\District::where('state_id', $state_id)->lists('name', 'id')->all();
        ksort($districts);
        return ($districts);
    }

}

if (!function_exists('get_doc_type_id')) {

    /**
     * Helper function to get id of a document type
     */
    function get_doc_type_id($doc_name)
    {
        return \App\DocType::where('name', $doc_name)->first()->id;
    }

}

if (!function_exists('get_victim_attachment')) {

    /**
     * Helper function to get newest attachment of a specified doc type
     */
    function get_victim_attachment($doc_name, $litigation_id)
    {
        return \App\Litigation::find($litigation_id)
            ->attachments()
            ->where('doc_type_id', get_doc_type_id($doc_name))
            ->orderBy('updated_at', 'desc')
            ->first();
    }

}

if (!function_exists('get_attachments_of_victim')) {

    /**
     * Helper function to get newest attachment of a specified doc type
     */
    function get_attachments_of_victim($doc_name, $litigation_id)
    {
        $attachments = \App\Litigation::find($litigation_id)
            ->attachments()
            ->where('doc_type_id', get_doc_type_id($doc_name))
            ->orderBy('updated_at', 'desc')->get();

        //dd($attachments->toArray());
        $dom = '';
        $items = $attachments->toArray();
        $count = count($items);
        if ($count > 0) {
            foreach ($items as &$item) {
                // print_r($item);
                $dom .= '<img src="' . $item['file_path'] . '">';
            }
        } else {
            $dom .= '<img src=/uploads/-text.png>';
        }
        //dd($dom);

        return ($dom);
    }

}

if (!function_exists('get_victim_child_image_attachment')) {

    /**
     * Helper function to get victim child image attachment
     */
    function get_victim_child_image_attachment($survivor_child)
    {
        return \App\Child::findOrFail($survivor_child)->child_image_attachment;
    }

}

if (!function_exists('set_case_id')) {

    /**
     * Helper function to create case id of a case
     */
    function set_case_id($rescued_from_country)
    {

        $country_code = \App\Country::findOrFail($rescued_from_country)->code;
        $case_creation_year_month = date('Ym', strtotime(\Carbon\Carbon::now()->toDateString()));
        $count_existing_case_on_this_month_of_this_year = \Illuminate\Support\Facades\DB::table('litigations')
            ->where('case_id', 'LIKE', $country_code . $case_creation_year_month . '-%')
            ->count();
        $incremental_value = sprintf("%04d", ++$count_existing_case_on_this_month_of_this_year);
        return $country_code . $case_creation_year_month . '-' . $incremental_value;
    }

}

if (!function_exists('calculate_age')) {

    /**
     * Helper function to get victim child image attachment
     */
    function calculate_age($dob)
    {
        $date = new DateTime($dob);
        $y = intval($date->format('Y'));
        $m = intval($date->format('m'));
        $d = intval($date->format('d'));
        $dt = Carbon\Carbon::createFromDate($y, $m, $d);

        $diffs[0] = $dt->diff(\Carbon\Carbon::now())->format('%y');
        $diffs[1] = $dt->diff(\Carbon\Carbon::now())->format('%m');

        return $diffs;
    }

}

if (!function_exists('time_ago')) {

    /**
     * Helper function to get victim child image attachment
     */
    function time_ago($date_time)
    {

        $date = new DateTime($date_time);
        $y = intval($date->format('Y'));
        $m = intval($date->format('m'));
        $d = intval($date->format('d'));
        $dt = Carbon\Carbon::createFromDate($y, $m, $d);

        echo $date_time->diffForHumans();
        //echo $date_time;
    }

}

if (!function_exists('organization_name_from_user_id')) {

    /**
     * Helper function to get organization name from user id
     */
    function organization_name_from_user_id($user_id)
    {
        $user = \App\User::FindOrFail($user_id);

        echo($user->organization()->get()[0]->name);
    }

}

if (!function_exists('organization_id_from_user_id')) {

    /**
     * Helper function to get organization name from user id
     */
    function organization_id_from_user_id($user_id)
    {
        $user = \App\User::FindOrFail($user_id);

        echo($user->organization()->get()[0]->id);
    }

}

if (!function_exists('message_receiver')) {

    /**
     * Helper function to get organization name from user id
     */
    function message_receiver($message_id)
    {
        $receipants = DB::table('message_organization')
            ->select(DB::raw('organizations.id , organizations.name as name'))
            ->join('organizations', 'organizations.id', '=', 'message_organization.organization_id')
            ->where('message_organization.message_id', $message_id)
            ->get();

        return ($receipants[0]->name);

    }

}

if (!function_exists('get_organization_country')) {

    /**
     * Helper function to get organization name from user id
     */
    function get_organization_country($org_id)
    {
        // return ($org_id);

        $org = \App\Organization::where('id', $org_id)->first();
        return $org->country;
        //dd($org[0]->country);
        //return $org->country;
    }

}

if (!function_exists('get_organization_state_from_district')) {

    /**
     * Helper function to get organization name from user id
     */
    function get_organization_state_from_district($district_id)
    {
        //dd($district_id);

        $district = \App\District::where('id', $district_id)->first();
        //dd($district);
        return $district->state->id;
        //dd($org[0]->country);
        //return $org->country;
    }

}

if (!function_exists('country_name_from_id')) {

    /**
     * Helper function to get organization name from user id
     */
    function country_name_from_id($country_id)
    {
        $cid = ($country_id == !null) ? $country_id : 1;
        //dd($cid);
        $country = DB::table('countries')
            ->where('id', $cid)
            ->select('name')->get()[0]->name;
        //dd($country);
        return (!empty($country)) ? $country : '';
    }

}

if (!function_exists('get_doc_type_from_id')) {

    /**
     * Helper function to get doc type name from doc type id
     */
    function get_doc_type_from_id($type_id)
    {
        $type_id = ($type_id == !null) ? $type_id : 1;
        //dd($cid);
        $doc_type = DB::table('doc_types')
            ->where('id', $type_id)
            ->select('name')->get()[0]->name;
        //dd($country);
        return (!empty($doc_type)) ? $doc_type : '';
    }

}
/*
 * Developed by Manoz
 */
function dateDiff($time1, $time2, $precision = 6)
{
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
        $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
        $time2 = strtotime($time2);
    }

    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
        $ttime = $time1;
        $time1 = $time2;
        $time2 = $ttime;
    }

    // Set up intervals and diffs arrays
    $intervals = array('year', 'month', 'day');
//    $intervals = array('year', 'month', 'day', 'hour', 'minute', 'second');
    $diffs = array();

    // Loop thru all intervals
    foreach ($intervals as $interval) {
        // Create temp time from time1 and interval
        $ttime = strtotime('+1 ' . $interval, $time1);
        // Set initial values
        $add = 1;
        $looped = 0;
        // Loop until temp time is smaller than time2
        while ($time2 >= $ttime) {
            // Create new temp time from time1 and interval
            $add++;
            $ttime = strtotime("+" . $add . " " . $interval, $time1);
            $looped++;
        }

        $time1 = strtotime("+" . $looped . " " . $interval, $time1);
        $diffs[$interval] = $looped;
    }

    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
        // Break if we have needed precission
        if ($count >= $precision) {
            break;
        }
        // Add value and interval
        // if value is bigger than 0
        if ($value > 0) {
            // Add s if value is not 1
            if ($value != 1) {
                $interval .= "s";
            }
            // Add value and interval to times array
            $times[] = $value . " " . $interval;
            $count++;
        }
    }

    // Return string with times
    return implode(", ", $times);
}

if (!function_exists('calculateDayMonthYearFromDays')) {
    function calculateDayMonthYearFromDays($days = 862)
    {
        $vmonths = '';
        $vdays = '';
        $vyears = '';
        if($days == 0){
            return 0;
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
//        if ($days / 30 >= 12) {
////            global $vmonths, $vdays, $vyears;
//            $vmonths = floor($days / 30);
//            $vdays = floor($days % 30);
//            if ($vmonths % 12 >= 1) {
////                global $vyears, $vmonths;
//                $vyears = floor($vmonths / 12);
//                $vmonths = floor($vmonths % 12);
//            }
//        }
//        if ($vyears == 0) {
//            $vyears = '';
//        } else if ($vyears > 1) {
//            $vyears = $vyears . ' years ';
//        } else {
//            $vyears = $vyears . ' year ';
//        }
////        $vyears = $vyears > 1 ? $vyears . ' years ' : $vyears . ' year ';
//        $vmonths = $vmonths > 1 ? $vmonths . ' months ' : $vmonths . ' month ';
//        $vdays = $vdays > 1 ? $vdays . ' days ' : $vdays . ' day ';
        return mergeYearMonthDay($vyears, ' year') .' '. mergeYearMonthDay($vmonths, ' month') .' '.mergeYearMonthDay($vdays, ' day') ;
    }

}

function mergeYearMonthDay($value, $text){
    if ($value == 0) {
        $value = '';
    } else if ($value > 1) {
        $value = $value . $text . 's';
    } else {
        $value = $value . $text;
    }
    return $value;
}

if (!function_exists('getDateDifference')) {
    function getDateDifference($from, $to)
    {
        $from = new \Carbon\Carbon($from);
        $to = new \Carbon\Carbon($to);
        return dateDiff($from, $to);
//        return $to->diffInDays($from);
    }
}

if (!function_exists('getContributorsListByCase')) {
    function getContributorsListByCase($id)
    {
        $contributors = DB::table('litigation_organization')
            ->select(DB::raw('organizations.id , organizations.name as name'))
            ->join('organizations', 'organizations.id', '=', 'litigation_organization.organization_id')
            ->where('litigation_organization.litigation_id', $id)
            ->get();
        return $contributors;
    }
}

if (!function_exists('countClosedCases')) {
    function countClosedCases()
    {
        $closedCases = DB::table('litigations')
            ->select(DB::raw('count(litigations.id) as cases'))
            ->where('litigations.status', 'closed')
            ->groupBy('litigations.status')
            ->get();
        return $closedCases ? $closedCases[0]->cases : 0;
    }
}
if (!function_exists('getOrganizationBelongsToACountry')) {
    function getOrganizationBelongsToACountry($cid)
    {
        $OrganizationsByCountry = DB::table('organizations')
            ->select(DB::raw('organizations.id, organizations.name AS organization'))
            ->where('organizations.country', $cid)
            ->orderBy('organizations.name')
            ->get();
    }
}

if (!function_exists('getOrganizationByCountry')) {
    function getOrganizationsByCountry($cid = 1)
    {
        $OrganizationsByCountry = DB::table('organizations')
            ->select(DB::raw('organizations.id, organizations.name AS organization'))
            ->where('organizations.country', $cid)
            ->orderBy('organizations.name')
            ->get();
//        ->toSql();

        return $OrganizationsByCountry;
    }
}

if (!function_exists('countOrganizationByCountry')) {
    function countOrganizationByCountry($cid)
    {
        $organizations = DB::table('organizations')
            ->select(DB::raw('count(organizations.id) as totalOrganizations'))
            ->where('organizations.country', $cid)
            ->groupBy('organizations.country')
            ->get()[0];
//        ->toSql();

        return $organizations->totalOrganizations;
    }
}

if (!function_exists('countLitigationsOfAnOrganizationByCountry')) {
    function countLitigationsOfAnOrganizationByCountry($cid)
    {
        $litigations = DB::table('litigation_organization')
            ->select(DB::raw('countries.name as country,litigation_organization.organization_id, organizations.name as organization, COUNT(litigation_organization.litigation_id) as litigaations'))
            ->join('organizations', 'organizations.id', '=', 'litigation_organization.organization_id')
            ->join('countries', 'countries.id', '=', 'organizations.country')
            ->where('countries.id', $cid)
            ->groupBy('litigation_organization.organization_id')
            ->get();
//        ->toSql();

        return $litigations;
    }
}


//if (!function_exists('countLitigationsOfAnOrganizationByCountry')) {
//    function countLitigationsOfAnOrganizationByCountry($cid)
//    {
//        $litigations = DB::table('litigations')
//            ->select(DB::raw('organizations.name AS organization, COUNT(litigations.id) AS totalLitigations'))
//            ->join('organizations', 'organizations.id', '=', 'litigations.concerned_organization')
//            ->where('organizations.country', $cid)
//            ->groupBy('litigations.concerned_organization')
//            ->get();
////        ->toSql();
//
//        return $litigations;
//    }
//}

if (!function_exists('getTotalLitigationOfAnOrganization')) {
    function getTotalLitigationOfAnOrganization($id = '')
    {
        $totalLitigations = DB::table('litigations')
            ->select(DB::raw('COUNT(litigations.case_id) as totalCases '))
            ->where('litigations.concerned_organization', $id)
            ->get()[0];
//        ->toSql();

        //return $totalLitigations->totalCases;
        return !empty($totalLitigations->totalCases) ? $totalLitigations->totalCases : 0;
    }
}

if (!function_exists('countTotalRescued')) {
    function countTotalRescued()
    {
        $totalRescued = DB::table('litigations')
            ->select(DB::raw('COUNT(*) AS totalRescued '))
            ->get()[0];
//        ->toSql();
        return !empty($totalRescued->totalRescued) ? $totalRescued->totalRescued : 0;
    }
}
//if (!function_exists('countRescuedByGender')) {
//    function countRescuedByGender()
//    {
//        $rescued = DB::table('litigations')
//            ->select(DB::raw('COUNT(*) AS total, sex, countries.name as country'))
//            ->join('countries', 'countries.id', '=', 'litigations.rescued_from_country')
//            ->groupBy(['litigations.sex', 'litigations.rescued_from_country'])
//            ->get();
////        ->toSql();
//        return $rescued;
//    }
//}

//if (!function_exists('showTotalRescuedToACountry')) {
//    function showTotalRescuedToACountry($cId = 1)
//    {
//        $totalRescued = DB::table('litigations')
//            ->select(DB::raw('COUNT(*) AS totalRescued'))
//            ->join('countries', 'countries.id', '=', 'litigations.country_of_origin')
//            ->where('litigations.country_of_origin', $cId)
//            ->where('litigations.sex', '!=', '(NULL)')
//            ->get()[0];
////        ->toSql();
////        return $totalRescued->totalRescued;
//        return !empty($totalRescued->totalRescued) ? $totalRescued->totalRescued : 0;
//    }
//}

if (!function_exists('countMaleRescuedOfACountry')) {
    function countMaleRescuedOfACountry($cId = 1)
    {
        $totalMaleRescued = DB::table('litigations')
            ->select(DB::raw('COUNT(*) AS totalMaleRescued, sex, countries.name'))
            ->join('countries', 'countries.id', '=', 'litigations.country_of_origin')
            ->where('litigations.country_of_origin', $cId)
            ->where('litigations.sex', 'M')
            ->get()[0];
//        ->toSql();
        return $totalMaleRescued->totalMaleRescued;
    }
}
if (!function_exists('countFemaleRescuedOfACountry')) {
    function countFemaleRescuedOfACountry($cId = 2)
    {
        $totalFemaleRescued = DB::table('litigations')
            ->select(DB::raw('COUNT(*) AS totalFemaleRescued'))
            ->join('countries', 'countries.id', '=', 'litigations.country_of_origin')
            ->where('litigations.country_of_origin', $cId)
            ->where('litigations.sex', 'F')
            ->get()[0];
//        ->toSql();
        return $totalFemaleRescued->totalFemaleRescued;
    }
}
//
//if (!function_exists('countTotalRescueOfACountry')) {
//    function countTotalRescueOfACountry($cId = 1)
//    {
//        $totalRescued = DB::table('litigations')
//            ->select(DB::raw('COUNT(litigations.`case_id`)'))
//            ->join('countries', 'countries.id', '=', 'litigations.country_of_origin')
////            ->where('litigations.country_of_origin',$cId)
////            ->where('litigations.sex','!=', '(NULL)')
//            ->groupBy('litigations.country_of_origin')
//            ->orderBy('countries.name')
//            ->get()[0];
////        ->toSql();
////        return $totalRescued->totalRescued;
//        return !empty($totalRescued->totalRescued) ? $totalRescued->totalRescued : 0;
//    }
//}

if (!function_exists('getLitigationByStatus')) {
    function getLitigationByStatus()
    {
        $cases = DB::table('litigations')
            ->select(DB::raw('litigations.status, COUNT(case_id) as totalCases'))
            ->groupBy('litigations.status')
            ->orderBy('litigations.status', 'desc')
            ->get();
        return $cases;
    }
}

if (!function_exists('getCountryOfOrigin')) {
    function getCountryOfOrigin()
    {
        $countryOfOrigin = DB::table('litigations')
            ->select(DB::raw('countries.id as country_id, countries.name as country, litigations.nationality as country_id, COUNT(litigations.case_id) AS totalRescued'))
            ->join('countries', 'countries.id', '=', 'litigations.nationality')
            ->groupBy('litigations.nationality')
            ->orderBy('countries.name')
            ->get();
        return $countryOfOrigin;
    }
}

if (!function_exists('countTotalRescuesByStateBelongsToACountry')) {
    function countTotalRescuesByStateBelongsToACountry($cid)
    {
        $totalRescues = DB::table('litigations')
            ->select(
                DB::raw('states.name AS state,litigations.rescued_from_state AS state_id,
                       COUNT(litigations.case_id) AS totalRescued')
            )
            ->join('countries', 'countries.id', '=', 'litigations.nationality')
            ->join('states', 'states.id', '=', 'litigations.rescued_from_state')
            ->where('litigations.nationality', $cid)
            ->groupBy('litigations.rescued_from_state')
            ->orderBy('litigations.rescued_from_state')
            ->get();
        return $totalRescues;
    }
}

if (!function_exists('calculatePercentageOfRescues')) {
    function calculatePercentageOfRescues($current, $total)
    {
        return round(($current / $total) * 100, 2) . '%';
    }
}

///count rescues from ngohirs table
if (!function_exists('countRescuesByAgeBelongsToACountry')) {
    function countRescuesByAgeBelongsToACountry($cid)
    {
        $totalRescues = DB::table('ngohirs')
            ->select(
                DB::raw('countries.name as country, ngohirs.age_year_part AS age, COUNT(ngohirs.litigation_id) AS totalRescues')
            )
            ->where('ngohirs.age_year_part', '!=', '(NULL)')
            ->join('litigations', 'litigations.id', '=', 'ngohirs.litigation_id')
            ->join('countries', 'countries.id', '=', 'litigations.nationality')
            ->where('countries.id', $cid)
            ->groupBy('ngohirs.age_year_part')
            ->get();
        return $totalRescues;
    }
}

if (!function_exists('groupTotalRescuesByAge')) {
    function groupTotalRescuesByAge($country = 1)
    {
        $underTwelve = '';
        $twelveTo18 = '';
        $eighteenTo25 = '';
        $above25 = '';
        $ageGroup = [];
        foreach (countRescuesByAgeBelongsToACountryFromLitigation($country) as $row) {
            if (intval($row->age) < 12) {
                $underTwelve += $row->totalRescues;
                $ageGroup["Under 12"] = $underTwelve;
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
                $ageGroup['Above 25'] = $above25;
            }
        }

        return $ageGroup;
    }
}



///count rescues from ngohirs table
if (!function_exists('editHistoryOfCaseStory')) {
    function editHistoryOfCaseStory($sid)
    {
        $case_story = \App\CaseStudy::find($sid);
        $revisions = $case_story->revisionHistory;

        return $revisions;
    }
}
///count rescues from ngohirs table
if (!function_exists('country_from_user_id')) {
    function country_from_user_id($user_id)
    {

        $country = DB::table('users')->select('countries.name')
            ->join('organizations','organizations.id','=','users.organization_id')
            ->join('countries','countries.id','=','organizations.country')
            ->where('users.id', $user_id)->get();
//dd($country);
        return $country[0]->name;
    }
}


//countrescues form litigiations table
if (!function_exists('countRescuesByAgeBelongsToACountryFromLitigation')) {
    function countRescuesByAgeBelongsToACountryFromLitigation($cid)
    {
        $totalRescues = DB::table('litigations')
            ->select(
                DB::raw('countries.name as country, litigations.age_year_part AS age, COUNT(litigations.id) AS totalRescues')
            )
            ->join('countries', 'countries.id', '=', 'litigations.nationality')
            ->where('countries.id', $cid)
            ->groupBy('litigations.age_year_part')
            ->get();
        return $totalRescues;
    }
}


