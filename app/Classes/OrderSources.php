<?php
namespace App\Classes;

class OrderSources{

    public static function getOrderSources() {

        $order_sources = array();
        $order_sources[0]= ['id'=>'1','name'=>'JJB'];
        $order_sources[1]= ['id'=>'2','name'=>'CWC Kolkata'];
        $order_sources[2]= ['id'=>'3','name'=>'Magistrate Court'];
        return $order_sources;
    }

    public static function OrderSource($index){
        foreach(OrderSources::getOrderSources() as $order_source){
            if($order_source['id']==$index){
                return $order_source['name'];
            }
        }
    }
}