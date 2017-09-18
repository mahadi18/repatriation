<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model {

    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }

    public static function taskMapping(){
        $tasks = DB::table('tasks as t1')
            ->leftjoin('tasks as t2 ', 't1.parent_id', '=', 't2.id')
            ->select('t1.*','t2.title as parent')
            ->orderBy('order', 'ASC')
            ->get();
        //dd($tasks);
        return $tasks;
    }

    public function status($lid,$tid){
        $query = DB::table('litigation_task_task_status')
            ->where('litigation_id', $lid)
            ->where('task_id', $tid)
            ->select('task_status_id')
            ->get();

        return $query ? $query[0]->task_status_id : 0;
    }

    public function country($lid,$tid){
        $selected_countries = DB::table('litigation_task_task_status')
            ->where('litigation_id', $lid)
            ->where('task_id', $tid)
            ->select('assigned_country')
            ->get();
       // dd($query);

        return $selected_countries ? $selected_countries : array();
    }

    public function defaultCountries($tid){
        $task= $this::findOrFail($tid);
        $defaults = array();
        if($task->countries){
            $defaults = explode(',', $task->countries);

        }
       // dd($defaults);
        return $defaults;
    }

    public static function getURLfromTaskID($tid)
    {

        switch ($tid) {
            case 2:
                $url = '/intake';
                break;
            case 3:
                $url = '/fir';
                break;
            case 4:
                $url = '/cwc';
                break;
            case 5:
                $url = '/magistrate-court-order';
                break;
            case 6:
                $url = '/counselling-report';
                break;
            case 7:
                $url = '/medical-report';
                break;
            case 8:
                $url = '/po-report';
                break;
            case 9:
                $url = '/nationality-identification';
                break;
            case 10:
                $url = '/ngo-hir';
                break;
            case 11:
                $url = '/state-hir';
                break;
            case 12:
                $url = '/repatriation-order';
                break;
            case 13:
                $url = '/issue-of-noc';
                break;
            case 14:
                $url = '/fixing-repatriation-date';
                break;
            case 15:
                $url = '/escort-and-handover';
                break;
            case 16:
                $url = '/repatriation';
                break;

            default:
                $url = '/intake';
                break;


        }

        return $url;

    }


}
