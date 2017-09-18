<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    /**
     * Get the Litigation that owns the family_member.
     */
    public function litigation()
    {
        return $this->belongsTo('App\Litigation');
    }
}
