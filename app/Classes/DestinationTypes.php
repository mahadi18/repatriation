<?php
namespace App\Classes;

class DestinationTypes{

    public static function getDestTypes() {

        $dest_types = array();
        $dest_types[0]= ['id'=>'2','name'=>'Shelter Home'];
        $dest_types[1]= ['id'=>'3','name'=>'Correctional Home'];
        $dest_types[2]= ['id'=>'4','name'=>'Jail'];
        $dest_types[3]= ['id'=>'5','name'=>'Hospital'];
        $dest_types[4]= ['id'=>'6','name'=>'Runway'];
        return $dest_types;
    }

    public static function DestType($index){
        foreach(Destinationtypes::getDestTypes() as $dst_types){
            if($dst_types['id']==$index){
                return $dst_types['name'];
            }
        }
    }
}