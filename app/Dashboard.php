<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use DB;
use App\Country;
use League\Fractal\Resource\Item;

class Dashboard extends Model
{
    public static function getInitiatedCasesByCountry($cid = 1)
    {
        $initiatedCasesByCountry = DB::table('litigations')
            ->select(
                DB::raw(
                    'COUNT(litigations.case_id) initialCases,
                     litigations.status as status, 
                     countries.id as countryId,
                     countries.name as country,
                     countries.latitude,
                     countries.longitude')
            )
            ->join('users', 'users.id', '=', 'litigations.created_by_id')
            ->join('organizations', 'organizations.id', '=', 'users.organization_id')
            ->join('countries', 'countries.id', '=', 'organizations.country')
//            ->whereBetween(DB::raw('DATE(litigations.updated_at)'), ['2016-03-28 ','2016-09-08 '])
//            ->where('countries.id', $cid)
            ->groupBy('organizations.country')
            ->orderBy('countries.name')
            ->get();

        return $initiatedCasesByCountry;
    }

    public static function getInitiatedCasesBetween($dFrom = '', $dTo = '')
    {
        $initiatedCases = DB::table('litigations')
            ->select(
                DB::raw(
                    'COUNT(litigations.case_id) initialCases,
                     litigations.status as status, 
                     countries.id as countryId,
                     countries.name as country,
                     countries.latitude,
                     countries.longitude')
            )
            ->join('users', 'users.id', '=', 'litigations.created_by_id')
            ->join('organizations', 'organizations.id', '=', 'users.organization_id')
            ->join('countries', 'countries.id', '=', 'organizations.country')
            ->whereBetween(DB::raw('DATE(litigations.updated_at)'), [$dFrom, $dTo])
//            ->where('litigations.status', 'closed')
            ->groupBy('organizations.country')
            ->orderBy('countries.name')
            ->get();

        return $initiatedCases;
    }

    public static function getInitiatedCasesWithStatus($cId = 1, $status = '')
    {
        $initiatedCases = DB::table('litigations')
            ->select(
                DB::raw(
                    'COUNT(litigations.case_id) initiatedCases'
                )
            )
            ->join('users', 'users.id', '=', 'litigations.created_by_id')
            ->join('organizations', 'organizations.id', '=', 'users.organization_id')
            ->join('countries', 'countries.id', '=', 'organizations.country');
        if ($status) {
            $initiatedCases->where('litigations.status', $status);
        }
        $initiatedCases->where('countries.id', $cId);
        $initiatedCases->groupBy(['countries.id']);
        $initiatedCases->orderBy('countries.name');
        $result = $initiatedCases->get();
        return $result ? $result[0]->initiatedCases : 0;
    }

    public static function getInitatedCases($options = [])
    {
        $initiatedCases = DB::table('litigations')
            ->select(
                DB::raw(
                    'COUNT(litigations.case_id) initiatedCases,
                     litigations.status,
                     countries.id as countryId,
                     countries.name as country,
                     countries.latitude,
                     countries.longitude')
            )
            ->join('users', 'users.id', '=', 'litigations.created_by_id')
            ->join('organizations', 'organizations.id', '=', 'users.organization_id')
            ->join('countries', 'countries.id', '=', 'organizations.country');

        if (!empty($options['dateFrom']) && !empty($options['dateTo'])) {
            $initiatedCases->whereBetween(DB::raw('DATE(litigations.updated_at)'), [$options['dateFrom'], $options['dateTo']]);
        }
        if (!empty($options['open'])) {
            if (!empty($options['dateFrom']) && !empty($options['dateTo'])) {
                $initiatedCases->whereBetween(DB::raw('DATE(litigations.updated_at)'), [$options['dateFrom'], $options['dateTo']]);
            }
            $initiatedCases->where('litigations.status', 'open');
        }
        if (!empty($options['closed'])) {
            if (!empty($options['dateFrom']) && !empty($options['dateTo'])) {
                $initiatedCases->whereBetween(DB::raw('DATE(litigations.updated_at)'), [$options['dateFrom'], $options['dateTo']]);
            }
            $initiatedCases->where('litigations.status', 'closed');
        }
        $initiatedCases->groupBy('countries.id');
        $initiatedCases->orderBy('countries.name');
//        $result = $initiatedCases->toSql();
        $result = $initiatedCases->get();
        return $result;
    }

    public static function getNumberOfOrganizationByCountry()
    {
        $organizations = DB::table('organizations')
            ->select(
                DB::raw(
                    'COUNT(organizations.country) totalOrganizations,
                     countries.id as countryId,
                     countries.name as country,
                     countries.latitude,
                     countries.longitude')
            )
            ->join('countries', 'countries.id', '=', 'organizations.country')
            ->groupBy('countries.name')
            ->orderBy('countries.name')
            ->get();
        return $organizations;
    }

    /**
     * @return array|static[]
     */
    public static function getNumberOfRescuesByState()
    {
        $rescues = DB::table('litigations')
            ->select(
                DB::raw(
                    'COUNT(litigations.case_id) totalRescues,
                    states.id state_id, 
                    states.name state,
                    countries.name AS country'
                )
            )
            ->join('states', 'states.id', '=', 'litigations.rescued_from_state')
            ->join('countries', 'countries.id', '=', 'states.country_id')
            ->groupBy('litigations.rescued_from_state')
            ->get();
        return $rescues;
    }

    public static function getCountryOfOrigin()
    {
        $countryOfOrigin = DB::table('litigations')
            ->select(DB::raw('countries.id as country_id, countries.name as country, litigations.country_of_origin as country_id, COUNT(litigations.case_id) AS totalRescued'))
            ->join('countries', 'countries.id', '=', 'litigations.country_of_origin')
            ->groupBy('litigations.country_of_origin')
            ->orderBy('countries.name')
            ->get();
        $result = [];


        foreach ($countryOfOrigin as $key => $item) {
            $country = $item->country;
            if($item->country == 'Bangladesh'){
                $country = 'Bangladeshi';
            } else{
                $country = 'Nepalese';
            }
            $result[$key] = [
                "country_id" => $item->country_id,
                "country" => $country,
                "totalRescued" => $item->totalRescued
            ];
        }
//        return response($result);
        return $countryOfOrigin;
    }

    public static function countRescuesByAge($cid, $status = '')
    {
        $totalRescues = DB::table('litigations')
            ->select(
                DB::raw('countries.name as country, litigations.age_year_part AS age, COUNT(litigations.id) AS totalRescues')
            )
            ->join('countries', 'countries.id', '=', 'litigations.country_of_origin')
            ->where('countries.id', $cid);
        if ($status) {
            $totalRescues->where('litigations.status', 'closed');
        }

        $totalRescues->groupBy('litigations.age_year_part');
        $result = $totalRescues->get();
        return $result;
    }

    public static function countTotaleRescuedOfACountry($cId = 1)
    {
        $totalRescued = DB::table('litigations')
            ->select(DB::raw('COUNT(litigations.case_id) AS total'))
            ->join('countries', 'countries.id', '=', 'litigations.nationality')
            ->where('litigations.nationality', $cId)
            ->get()[0]->total;

        //dd($totalMaleRescued);
//        return intval($totalRescued ? $totalRescued[0]->$totalRescued : 0);
        return $totalRescued;
    }

    public static function countMaleRescuedOfACountry($cId = 1)
    {
        $totalMaleRescued = DB::table('litigations')
            ->select(DB::raw('COUNT(*) AS totalMaleRescued, sex, countries.name'))
            ->join('countries', 'countries.id', '=', 'litigations.nationality')
            ->where('litigations.nationality', $cId)
//            ->where('litigations.status', 'open')
            ->where('litigations.sex', 'M')
            ->get();

        //dd($totalMaleRescued);
        return intval($totalMaleRescued ? $totalMaleRescued[0]->totalMaleRescued : 0);
    }

    public static function countRepatriatedMaleByCountry($id = 1)
    {
        $totalRepatriatedMale = DB::table('litigations')
            ->select(DB::raw('COUNT(*) AS totalRepatriatedMale, sex, countries.name'))
            ->join('countries', 'countries.id', '=', 'litigations.nationality')
            ->where('litigations.nationality', $id)
            ->where('litigations.status', 'closed')
            ->where('litigations.sex', 'M')
            ->get();

        //dd($totalMaleRescued);
        return intval($totalRepatriatedMale ? $totalRepatriatedMale[0]->totalRepatriatedMale : 0);
    }

    public static function countFemaleRescuedOfACountry($cId = 2)
    {
        $totalFemaleRescued = DB::table('litigations')
            ->select(DB::raw('COUNT(*) AS totalFemaleRescued'))
            ->join('countries', 'countries.id', '=', 'litigations.nationality')
            ->where('litigations.nationality', $cId)
//            ->where('litigations.status', 'open')
            ->where('litigations.sex', 'F')
            ->get();
        return intval($totalFemaleRescued ? $totalFemaleRescued[0]->totalFemaleRescued : 0);
    }

    public static function countRepatriatedFemaleByCountry($id)
    {
        $totalRepatriatedFemale = DB::table('litigations')
            ->select(DB::raw('COUNT(*) AS totalRepatriatedFemale'))
            ->join('countries', 'countries.id', '=', 'litigations.nationality')
            ->where('litigations.nationality', $id)
            ->where('litigations.status', 'closed')
            ->where('litigations.sex', 'F')
            ->get();
        return intval($totalRepatriatedFemale ? $totalRepatriatedFemale[0]->totalRepatriatedFemale : 0);
    }

    /*
     * Functions for single ngo
     */
    public static function countContributedOpenClosedLitigationByOrganization($id, $status = 'open')
    {
        $totalLitigations = DB::table('litigation_organization')
            ->select(DB::raw('COUNT(*) as cases'))
            ->join('litigations', 'litigations.id', '=', 'litigation_organization.litigation_id')
            ->where('litigation_organization.organization_id', $id)
//            if($status)
            ->where('litigations.status', '=', $status)
            ->groupBy('litigation_organization.organization_id')
            ->get();
//            ->toSql();
        return $totalLitigations ? $totalLitigations[0]->cases : 0;
    }

    public static function countContributedLitigationByOrganization($id)
    {
        $totalLitigations = DB::table('litigation_organization')
            ->select(DB::raw('COUNT(*) as cases'))
            ->where('litigation_organization.organization_id', $id)
            ->groupBy('litigation_organization.organization_id')
            ->get();
//            ->toSql();
        return $totalLitigations ? $totalLitigations[0]->cases : 0;
    }

    public static function getContributedLigitgationsByOrganization($id)
    {
        $litigations = DB::table('litigations')
            ->select(DB::raw('litigations.case_id,litigations.name_during_rescue as name, litigations.status, countries.name country'))
            ->join('countries', 'countries.id', '=', 'litigations.country_of_origin')
            ->join('litigation_organization', 'litigations.id', '=', 'litigation_organization.litigation_id')
            ->where('litigation_organization.organization_id', $id)
            ->get();
//            ->toSql();
        return $litigations;
    }

    public static function countInitiatedOpenClosedLitigationsByOrganization($id, $status = 'open')
    {
        $totalLitigations = DB::table('litigations')
            ->select(DB::raw('COUNT(*) as totalCases'))
            ->where('litigations.created_by_id', $id)
            ->where('litigations.status', $status)
            ->get();
//            ->toSql();
//        return $totalLitigations;
        return $totalLitigations ? $totalLitigations[0]->totalCases : 0;
    }

    public static function countInitiatedLitigationsByOrganization($id)
    {
        $totalLitigations = DB::table('litigations')
            ->select(DB::raw('COUNT(*) as totalCases'))
            ->where('litigations.created_by_id', $id)
            ->get();
//            ->toSql();
//        return $totalLitigations;
        return $totalLitigations ? $totalLitigations[0]->totalCases : 0;
    }

    public static function getInitiatedLitigationsByOrganization($id)
    {
        $litigations = DB::table('litigations')
            ->select(DB::raw('litigations.case_id,litigations.name_during_rescue as name, litigations.status, countries.name country'))
            ->join('countries', 'countries.id', '=', 'litigations.country_of_origin')
            ->where('litigations.created_by_id', $id)
            ->get();
//            ->toSql();
        return $litigations;
    }

    public static function countCasesWithoutStateHIR($logged_organization = '')
    {
        return count(self::getLitigationWithIncompleteStateHir($logged_organization));
    }

    public static function countCasesWithoutNgoHirs()
    {
        $totalCases = DB::table('litigations')
            ->select(DB::raw('count(*) as cases'))
            ->leftJoin('countries', 'countries.id', '=', 'litigations.country_of_origin')
            ->whereNotIn('litigations.id', function ($query) {
                $query->select('ngohirs.litigation_id')->from('ngohirs');
            })
            ->get();
//        return $totalCases;
        return $totalCases ? $totalCases[0]->cases : 0;
    }

    public static function getCasesWithoutNgoHirs()
    {
        $litigations = DB::table('litigations')
            ->select(
                DB::raw('
                litigations.id litigition_id,
                litigations.case_id,
                litigations.name_during_rescue as name,
                litigations.status,
                countries.name country
                '),
                DB::raw('(
                SELECT organizations.name
                FROM organizations
                INNER JOIN litigations ON litigations.concerned_organization =  organizations.id
                WHERE litigations.id = litigition_id
                ) as organization
                ')
            )
            ->leftJoin('countries', 'countries.id', '=', 'litigations.country_of_origin')
            ->whereNotIn('litigations.id', function ($query) {
                $query->select('ngohirs.litigation_id')->from('ngohirs');
            });
        $result = $litigations->get();
        return $result;
    }

    public static function countCasesWithNgoHirsButOpened()
    {
        $litigations = DB::table('litigations')
            ->select(DB::raw('count(*) as cases'))
            ->join('ngohirs', 'ngohirs.litigation_id', '=', 'litigations.id')
            ->leftJoin('countries', 'countries.id', '=', 'litigations.country_of_origin')
            ->get();
        return $litigations ? $litigations[0]->cases : 0;
    }

    public static function getCasesWithNgoHirsButOpened()
    {
        $litigations = DB::table('litigations')
            ->select(DB::raw('litigations.case_id,litigations.name_during_rescue as name, litigations.status, countries.name country'))
            ->join('ngohirs', 'ngohirs.litigation_id', '=', 'litigations.id')
            ->leftJoin('countries', 'countries.id', '=', 'litigations.country_of_origin')
            ->get();
        return $litigations;
    }

    public static function getLitigationWithTimeDurationForClosedCases()
    {
        $litigations = DB::table('litigations')
            ->select(
                DB::raw(
                    'litigations.id, 
                    litigations.case_id, 
                    litigations.name_during_rescue victims, 
                    countries.name nationality, 
                    litigations.updated_at,
                    litigations.created_at'
                )
            )
            ->join('countries', 'countries.id', '=', 'litigations.nationality')
            ->where('litigations.status', 'closed')
            ->get();
        return $litigations;
    }

    public static function getContributorListByCase($id)
    {
        $contributors = DB::table('litigation_organization')
            ->select(DB::raw('organizations.name as name'))
            ->join('organizations', 'organizations.id', '=', 'litigation_organization.organization_id')
            ->where('litigation_organization.litigation_id', $id)
            ->get();
        return $contributors;
    }

    public static function countLitigationsOfAnOrganizationByCountry($cName = 'Bangladesh')
    {
        $litigations = DB::table('litigation_organization')
            ->select(DB::raw('organizations.name as organization, COUNT(litigation_organization.litigation_id) as litigations'))
            ->join('organizations', 'organizations.id', '=', 'litigation_organization.organization_id')
            ->join('countries', 'countries.id', '=', 'organizations.country')
            ->where('countries.name', $cName)
            ->groupBy('litigation_organization.organization_id')
            ->get();
//        ->toSql();

        return $litigations;
    }

    public static function countOrganizationsByCountry()
    {
        $organizationsByCountry = DB::table('organizations')
            ->select(DB::raw('countries.id as country_id, countries.name as country, COUNT(organizations.id) as totalOrganizations'))
            ->join('countries', 'countries.id', '=', 'organizations.country')
            ->groupBy('organizations.country')
            ->get();

        return $organizationsByCountry;
    }

    public static function getLitigationWithIncompleteStateHir($oId = '')
    {
        $litigations = DB::table('litigations')
            ->select(
                DB::raw('
                DISTINCT litigations.id as litigition_id,
                litigations.case_id,litigations.name_during_rescue, litigation_task_task_status.task_id,
                countries.name country,litigation_task_task_status.created_at
                '),
                DB::raw('(
                SELECT organizations.name
                FROM organizations
                INNER JOIN litigations ON litigations.concerned_organization =  organizations.id
                WHERE litigations.id = litigition_id
                ) as organization
                ')
            )
            ->join('litigation_task_task_status', 'litigation_task_task_status.litigation_id', '=', 'litigations.id')
            ->join('countries', 'countries.id', '=', 'litigations.nationality')
            ->where('litigation_task_task_status.task_id', 10)
            ->where('litigation_task_task_status.task_status_id', '!=', 4);
        if ($oId != '') {
            $litigations->where('litigations.concerned_organization', $oId);
        }
        $result = $litigations->get();

        return $result;
    }

    public static function completedNgoHrWithTimeDurationByCountry($cId, $oId = 0)
    {
        $organizationsWithNgoHr = DB::table('litigation_task_task_status')
            ->select(
                DB::raw(
                    'litigations.status, 
                    organizations.name name, 
                    COUNT(DISTINCT litigation_task_task_status.litigation_id)AS totalNgoHr, 
                    countries.name nationality, 
                    MIN(TIMESTAMPDIFF(day, litigations.created_at,litigation_task_task_status.created_at)) AS mintime,
                    MAX(TIMESTAMPDIFF(day, litigations.created_at,litigation_task_task_status.created_at)) AS maxtime,
                    avg(TIMESTAMPDIFF(day, litigations.created_at,litigation_task_task_status.created_at)) AS avgtime
                    '
                )
            )
            ->join('ngohirs', 'ngohirs.litigation_id', '=', 'litigation_task_task_status.litigation_id')
            ->join('litigations', 'litigations.id', '=', 'ngohirs.litigation_id')
            ->join('organizations', 'organizations.id', '=', 'litigations.concerned_organization')
            ->join('countries', 'countries.id', '=', 'litigations.country_of_origin')
            ->where('litigation_task_task_status.task_id', 9)
            ->where('litigation_task_task_status.task_status_id', 4)
            ->where('organizations.country', $cId);
        if ($oId != 0) {
            $organizationsWithNgoHr->where('organizations.id', $oId);
        }
        $organizationsWithNgoHr->groupBy(['litigations.concerned_organization', 'litigations.country_of_origin']);
        $result = $organizationsWithNgoHr->get();
        return $result;
    }

    public static function getOrganizationsByCountry($cid = 1)
    {
        $OrganizationsByCountry = DB::table('organizations')
            ->select(DB::raw('organizations.id as organization_id, organizations.name AS organization'))
            ->where('organizations.country', $cid)
//            ->orderBy('organizations.name')
            ->get();
//        ->toSql();

        return $OrganizationsByCountry;
    }

    public static function getAchievableTaskMatrixWithTimeDuration()
    {
        $tasks = DB::table('litigation_task_task_status')
            ->select(
                DB::raw('
                  tasks.title task, tasks.id task_id,
                  COUNT(litigation_task_task_status.task_id) AS totalTasks,
                  MIN(TIMESTAMPDIFF(DAY, litigations.created_at,litigation_task_task_status.created_at)) AS mintime,
                  MAX(TIMESTAMPDIFF(DAY, litigations.created_at, litigation_task_task_status.created_at)) AS maxtime,
                  AVG(TIMESTAMPDIFF(DAY, litigations.created_at,litigation_task_task_status.created_at)) AS avgtime
               ')
            )
            ->join('tasks', 'tasks.id', '=', 'litigation_task_task_status.task_id')
            ->join('litigations', 'litigations.id', '=', 'litigation_task_task_status.litigation_id')
            ->where('litigation_task_task_status.task_status_id', 4)
            ->groupBy('litigation_task_task_status.task_id')
            ->get();
        return $tasks;
    }

    public static function getYearWiseRepatriation()
    {
        $rescued = DB::table('litigations')
            ->select(
                DB::raw('
                     COUNT(litigations.case_id) totalRescued, 
                     litigations.status, countries.name country, 
                     YEAR(litigations.updated_at) year
                     '
                )
            )->join('countries', 'countries.id', '=', 'litigations.country_of_origin')
//            ->where('litigations.status', 'closed')
            ->groupBy([DB::raw('YEAR(litigations.updated_at)'), 'litigations.country_of_origin'])
            ->orderBy('litigations.country_of_origin')
            ->get();
//        ->toSql();

        return $rescued;
    }

    public static function getRescuesByYear()
    {
        $rescued = DB::table('litigations')
            ->select(DB::raw('DISTINCT YEAR(litigations.updated_at) year'),
                DB::raw('(
                    SELECT COUNT(litigations.case_id)FROM litigations 
                    WHERE litigations.country_of_origin=1 AND YEAR(litigations.updated_at) = year
                    GROUP BY YEAR(litigations.updated_at),litigations.country_of_origin
                    ) AS bd'
                ),
                DB::raw('(
                    SELECT COUNT(litigations.case_id)FROM litigations 
                    WHERE litigations.country_of_origin=3 AND YEAR(litigations.updated_at) = year
                    GROUP BY YEAR(litigations.updated_at),litigations.country_of_origin
                    ) AS nepal'
                )
            )
            ->get();
        return $rescued;
    }

    public static function getRepatirationsByYear()
    {
        $rescued = DB::table('litigations')
            ->select(DB::raw('DISTINCT YEAR(litigations.updated_at) year'),
                DB::raw('(
                    SELECT COUNT(litigations.case_id)FROM litigations 
                    WHERE litigations.status = "closed" AND litigations.country_of_origin=1 AND YEAR(litigations.updated_at) = year
                    GROUP BY YEAR(litigations.updated_at),litigations.country_of_origin
                    ) AS bd'
                ),
                DB::raw('(
                    SELECT COUNT(litigations.case_id)FROM litigations 
                    WHERE litigations.status = "closed" AND litigations.country_of_origin=3 AND YEAR(litigations.updated_at) = year
                    GROUP BY YEAR(litigations.updated_at),litigations.country_of_origin
                    ) AS nepal'
                )
            )
            ->get();
        return $rescued;
    }

    public static function getStateWiseRepatriation($cId, $status = '')
    {
        $rescued = DB::table('litigations')
            ->select(
                DB::raw('
                    COUNT(litigations.case_id) rescues, 
                    states.id state_id,
                    states.name state,
                    countries.name AS country, 
                    litigations.nationality,
                    (SELECT countries.name FROM countries WHERE countries.id = litigations.nationality) AS countryOfOrigin
                     '
                )
            )
            ->join('states', 'states.id', '=', 'litigations.rescued_from_state')
            ->join('countries', 'countries.id', '=', 'states.country_id')
            ->where('litigations.nationality', $cId);
        if ($status) {
            $rescued->where('litigations.status', 'closed');
        }

        $rescued->groupBy('litigations.rescued_from_state', 'litigations.nationality');
        $rescued->orderBy('litigations.nationality');
        $result = $rescued->get();
//            ->toSql();
        return $result ? $result : [];
    }
}
