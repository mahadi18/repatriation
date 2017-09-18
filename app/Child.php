<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    /**
     * Get the Litigation that owns the child.
     */
    public function litigation()
    {
        return $this->belongsTo('App\Litigation');
    }
}
