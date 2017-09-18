<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CarePlan extends Model {

	//
    public function shelterHomes()
    {
        return $this->belongsToMany('App\ShelterHome');
    }

    public function litigations()
    {
        return $this->belongsToMany('App\Litigation');
    }

    public static function getPlanNamesFromIds($cp_ids) {
        $names = '';
        $total = count($cp_ids);
        $count=1;
        foreach($cp_ids as $cp_id) {
            $cp = CarePlan::findOrFail($cp_id);
            $suffix = ($count==$total)?'':', ';
            $names = $names.$cp->title.$suffix;
            $count++;
        }
        return $names;
    }
}
