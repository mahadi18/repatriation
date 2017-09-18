<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Litigation;
use App\Ngohir;
use App\Attachment;
use App\Address;

class PrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ngoHir($id)
    {
        $litigation = Litigation::findOrFail($id);
        $ngohir = Ngohir::where('litigation_id', $id)->first();
        //dd($ngohir);
        if($ngohir){
        $ngohir['files'] = Attachment::getNGOHIRAttachments($id);
        $ngohir['addresses'] = Address::getHierarchiedAddress($lid=$id,$tid=9);
       // dd($ngohir);
        return view('print.ngohir', compact('litigation','ngohir'));
        }
        else {
            return redirect('/cases/'.$id.'?tid=9')->with('error', 'Information has to be added before printing this page');
        }
    }

    public function fullProfile($id)
    {
        $litigation = Litigation::findOrFail($id);
        $litigation->attachemnt = Attachment::getAttachemntForLitigation($id);
            return view('print.fullprofile', compact('litigation','ngohir'));

    }


}
