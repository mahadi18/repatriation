<?php
namespace App\Classes;

class Acts{

    public static function getActList() {

        $acts = array();
        $acts[0]= ['id'=>'1','name'=>'Act1'];
        $acts[1]= ['id'=>'2','name'=>'Act2'];
        $acts[2]= ['id'=>'3','name'=>'Act3'];
        return $acts;
    }

    public static function organization($id){
        foreach(Acts::getActList() as $act){
            if($act['id']==$id){
                return $act['name'];
            }
        }
    }
}