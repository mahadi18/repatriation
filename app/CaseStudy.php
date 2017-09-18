<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Venturecraft\Revisionable\RevisionableTrait; // Model Auditing

class CaseStudy extends Model
{
    use RevisionableTrait;
    protected $revisionEnabled = true;

    protected $revisionFormattedFieldNames = array(
        'title' => 'Title',
        'case_id' => 'Case ID',
        'description' => 'Description',
        'user_id' => 'User ID',
        'litigation_id' => 'Case ID'
    );


    public static function initializeForCase($lid){
        $case_studies = ['Rescue Story','Victim Statement','Probation Officer Statement'];
            foreach($case_studies as $case_study){
                $cs= New CaseStudy();
                $cs->litigation_id = $lid;
                $cs->user_id = Auth::user()->id;
                $cs->deletable = 0;
                $cs->title = $case_study;
                $cs->description = '';
                $cs->save();
            }
    }
}
