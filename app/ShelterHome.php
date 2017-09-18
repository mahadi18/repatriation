<?php namespace App;

use App\Classes\Countries;
use App\Classes\Usability;
use Illuminate\Database\Eloquent\Model;
use \Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Support\Facades\DB;
use App\ServiceManagement;

class ShelterHome extends Model {

    protected $table = 'organizations';



    public function identifiableName()
    {
        return $this->name;
    }
   	//
    public function carePlans()
    {
        return $this->belongsToMany('App\CarePlan');
    }

    public function litigations()
    {
        return $this->hasMany('App\Litigation');
    }

    public static function getShelterhomeCarePlanLitigation($id){
        $care_plan_progresses = DB::table('care_plan_litigation')

            ->leftjoin('care_plans', 'care_plans.id', '=', 'care_plan_litigation.care_plan_id')
            ->leftjoin('care_plan_shelter_home', 'care_plan_shelter_home.care_plan_id', '=', 'care_plans.id')
            ->leftjoin('litigations', 'litigations.id', '=', 'care_plan_litigation.litigation_id')
            ->where('care_plan_shelter_home.shelter_home_id', $id)
            ->select('care_plans.title', 'care_plan_litigation.litigation_id', 'care_plan_litigation.status','care_plan_litigation.care_plan_id as id', 'care_plan_litigation.updated_at', 'care_plan_shelter_home.shelter_home_id as care_plan_id','litigations.name_during_rescue')
            ->orderBy('care_plan_litigation.updated_at', 'desc')
            ->get();

        return $care_plan_progresses;
    }

    public function country_name($id){
        return Countries::getCountryList()[$id-1]['name'];
    }

    public function service($id){
     //   dd($id);
        $service = ServiceManagement::find($id);
       // dd($service);
        if($service) {
            return $service->title;
        }

    }

}
