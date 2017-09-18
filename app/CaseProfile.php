<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CaseProfile extends Model {

	//

    public static function getHistory($litigation_id){
        //dd($litigation_id);

        $case_history = DB::table('case_profiles')
            ->join('litigations', 'case_profiles.litigation_id', '=', 'litigations.id')
            ->join('activities', 'case_profiles.activity_id', '=', 'activities.id')
            ->join('tasks', 'case_profiles.task_id', '=', 'tasks.id')
            ->select('litigations.name_during_rescue','litigations.id as litigation_id', 'activities.title as activity_title', 'tasks.title as task_title','case_profiles.comments','case_profiles.created_at')
            ->where('litigations.id', '=', $litigation_id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return $case_history;

    }

}
