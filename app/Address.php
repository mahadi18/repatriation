<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * Get the Litigation that owns the address.
     */
    public function litigation()
    {
        return $this->belongsTo('App\Litigation');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
    }

    public static function getHierarchiedAddress($lid,$tid){
        $result = \App\Address::where('litigation_id', $lid)->where('task_id', $tid)->get();
        return $result;

    }
}
