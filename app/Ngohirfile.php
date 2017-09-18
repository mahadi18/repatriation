<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ngohirfile extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function docType()
    {
        return $this->belongsTo('App\Doctype');
    }
}
