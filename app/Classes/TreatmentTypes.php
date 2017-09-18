<?php
namespace App\Classes;

class TreatmentTypes{

    public static function getTreatmentTypes() {

        $treatment_types = array();
        $treatment_types[0]= ['id'=>'1','name'=>'Medical'];
        $treatment_types[1]= ['id'=>'2','name'=>'Psycho Social'];
        $treatment_types[2]= ['id'=>'3','name'=>'Legal'];
        $treatment_types[3]= ['id'=>'4','name'=>'Life- Skill Training'];
        return $treatment_types;
    }

    public static function TreatmentType($index){
        foreach(TreatmentTypes::getTreatmentTypes() as $treatment_types){
            if($treatment_types['id']==$index){
                return $treatment_types['name'];
            }
        }
    }
}