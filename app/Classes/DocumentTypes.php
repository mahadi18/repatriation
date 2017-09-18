<?php
namespace App\Classes;

class DocumentTypes{

    public static function getDocumentTypes() {

        $document_types = array();
        $document_types[0]= ['id'=>'1','name'=>'Custody Order'];
        $document_types[1]= ['id'=>'2','name'=>'CWC Order'];
        return $document_types;
    }

    public static function DocType($index){
        foreach(DocumenTypes::getDocumentTypes() as $doc_types){
            if($doc_types['id']==$index){
                return $doc_types['name'];
            }
        }
    }
}