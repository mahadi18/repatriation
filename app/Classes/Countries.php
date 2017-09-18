<?php
namespace App\Classes;

class Countries{

    public static function getCountryList() {

        $countries = array();
        $countries[0]= ['id'=>'1','name'=>'Bangladesh','code'=>'BD'];
        $countries[1]= ['id'=>'2','name'=>'India','code'=>'IN'];
        $countries[2]= ['id'=>'3','name'=>'Nepal','code'=>'NP'];
        return $countries;
    }

    public static function Country($index){
        foreach(Countries::getCountryList() as $country){
            if($country['id']==$index){
                return $country['name'];
            }
        }
    }
}