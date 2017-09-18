<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Country extends Model
{
    //
    public static function getCountryNameFromID($id){
        $cid = ($id==!null) ? $id : 1;
        //dd($cid);
        $country = DB::table('countries')
            ->where('id', $cid)
            ->select('name')->get()[0]->name;
        //dd($country);
        return (!empty($country)) ? $country:'';
    }
}
