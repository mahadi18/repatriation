<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function care_plan()
    {
        return $this->belongsTo('App\CarePlan');
    }
}
