<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classes\TreatmentTypes;

class Care extends Model
{
    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function get_treatment_type($id)
    {
        return TreatmentTypes::TreatmentType($id);
    }
}
