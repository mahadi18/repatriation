<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actpoint extends Model
{
    public function proceedings()
    {
        return $this->belongsToMany('App\Proceeding');
    }
}
