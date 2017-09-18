<?php
namespace App\Classes;

class Organizations{

    public static function getOrgList() {

        /*$organizations = array();
        $organizations[0]= ['id'=>'1','name'=>'NGO'];
        $organizations[1]= ['id'=>'2','name'=>'Shelter Home'];*/
        $organizations = ['1' =>'NGO', '2' => 'Shelter Home'];

        return $organizations;
    }

    public static function organization($id){
        foreach(Organizations::getOrgList() as $org){
            if($org['id']==$id){
                return $org['name'];
            }
        }
    }
}