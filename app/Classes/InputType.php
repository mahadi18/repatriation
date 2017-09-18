<?php
namespace App\Classes;

class InputType{

    public static function getInputTypeList() {

        $acts = array();
        $acts[0]= ['id'=>'1','name'=>'Text', 'value'=>'text'];
        $acts[1]= ['id'=>'2','name'=>'Date', 'value'=>'date'];
        $acts[2]= ['id'=>'3','name'=>'Rich Text Editor', 'value'=>'rte'];
        return $acts;
    }

    public static function input_type($id){
        foreach(InputType::getInputTypeList() as $inp){
            if($inp['id']==$id){
                return $inp['name'];
            }
        }
    }
}