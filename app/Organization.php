<?php namespace App;

use App\Classes\Countries;
use App\Classes\Organizations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Support\Facades\Auth;
use Venturecraft\Revisionable;

class Organization extends Model {
    use SearchableTrait;


    protected $searchable = [
        'columns' => [
            'name' => 10,
            'address' => 10,
            'country' => 10,
            'description' => 10,
        ],
    ];
	//

    public static function attachToOrganization($organization_id, $user_id) {
        DB::insert('insert into organization_user (organization_id, user_id) values (?, ?)', [$organization_id, $user_id]);
    }

    public static function getOrganizationIdFromUserId($user_id) {
        $results = DB::select('select organization_id from organization_user where user_id = ?', [$user_id]);
        if(!empty($results))
        {
            return $results[0]->organization_id;
        }
        else {
            return 0;
        }

    }

    public function message()
    {
        return $this->belongsToMany('App\Message');
    }
    public function district()
    {
        return $this->belongsTo('App\District');
    }

    public function users(){
        return $this->hasMany('App\User');
    }

    public function litigations(){
        return $this->belongsToMany('App\Organization');
    }

    public function country_name($index){
        $country = DB::table('countries')
            ->where('id', $index)
            ->get();
        return isset($country[0]) ? $country[0]->name : '';
    }

    public function district_name($index){
        $district = DB::table('districts')
            ->where('id', $index)
            ->get();
        return isset($district[0]) ? $district[0]->name : '';
    }

    public function org_type($index){
        $results = Organizations::getOrgList();
        $org_name = 'hello';
        foreach($results as $key => $value){
            if($index == $key){
                $org_name = $value;
                break;
            }
        }
        //dd($org_name);
        return $org_name;
    }



    public static function getLoggedOrganization(){
        $organization = DB::select('select organization_id from users where id = ?',[Auth::user()->id]);
        return $organization[0]->organization_id;
    }

    public static function getOrganizationNamesFromIds($nids){
        $organizations = '';
        $count = 1;
        foreach ($nids as $nid){
            $results = DB::select('select name from organizations where id = ?', [$nid]);
            $separator = ($count < count($nids))?', ':'';
            $organizations.= $results[0]->name.$separator;
            $count++;
        }

        return $organizations;
    }

    public static function authorized_orgs($lid){
        $orgs = DB::table('litigation_organization')
                ->where('litigation_id', $lid)
                ->select('organization_id')
                ->get();
        return $orgs;
    }

    public static function getCategorizedOrgs($org_type_id){
        $shelter_homes = DB::table('organizations')
                ->where('org_type', $org_type_id)
                ->get();
        return $shelter_homes;
    }


    public static function notifiableOrgs($lid,$tid){
        $orgs = DB::table('litigation_organization')
                ->where('litigation_id', $lid)
                ->where('organization_id', '!=',Auth::user()->organization()->get()[0]->id)
                ->select('organization_id')
                ->get();
        $organizations = array();
        foreach($orgs as $key => $org) {
            $organizations[$key] = $org->organization_id;
        }

        return $organizations;
    }

    /*
     * Count total litigation of each organization
     */
    public static function countLitigationByOrganization(){
        $litigationsByOrganization = DB::table('litigations')
            ->join('organizations', 'organizations.id', '=', 'litigations.concerned_organization')
            ->join('countries', 'countries.id', '=', 'organizations.country')
            ->groupBy(['organizations.country','litigations.concerned_organization'])
            ->orderBy('organizations.country')
            ->select(DB::raw('countries.id as country_id, countries.name as country, organizations.id as organization_id, organizations.name as organization, COUNT(litigations.case_id) AS totalCases'))
            ->get();
//        ->toSql();

        return $litigationsByOrganization;
    }
}
