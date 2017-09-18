<?php

namespace App\Helpers;

use DB;
use App\User;
use App\Country;
use App\Litigation;
use App\Organization;

class LitigationHelper
{
    public static function countLitigationByOrganization($id){
        $litigationsByOrganization = DB::table('litigations')
            ->join('organizations', 'organizations.id', '=', 'litigations.concerned_organization')
            ->join('countries', 'countries.id', '=', 'organizations.country')
            ->groupBy(['organizations.country','litigations.concerned_organization'])
            ->orderBy('organizations.country')
            ->select(DB::raw('countries.name as country, organizations.name as organization, COUNT(litigations.case_id) AS totalCases'))
            ->get();
//        ->toSql();

        return $litigationsByOrganization;
    }
}