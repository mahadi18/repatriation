<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proceeding extends Model
{
    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }

    public function actpoints()
    {
        return $this->belongsToMany('App\Actpoint');
    }
}
