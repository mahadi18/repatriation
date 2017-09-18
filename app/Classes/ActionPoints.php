<?php
namespace App\Classes;

class ActionPoints{

    public static function getActionPoints() {

        $action_points = array();
        $action_points[0]= ['id'=>'1','title'=>'Assign an NGO to care the victim'];
        $action_points[1]= ['id'=>'2','title'=>'Assign an NGO to care repatriation process'];
        $action_points[2]= ['id'=>'3','title'=>'Withheld of Repatriation'];
        $action_points[3]= ['id'=>'4','title'=>'Order of restoration a child to an institution'];
        return $action_points;
    }

    public static function ActionPoint($index){
        foreach(ActionPoints::getActionPoints() as $action_point){
            if($action_point['id']==$index){
                return $action_point['name'];
            }
        }
    }
}