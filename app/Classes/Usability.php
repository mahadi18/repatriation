<?php
namespace App\Classes;

use App\Task;
use App\TaskStatus;
use Illuminate\Support\Facades\DB;

class Usability
{

    public static $item_per_page = 10;

    /**
     * @return mixed
     */
    public static function getIntakeId()
    {
        return Task::where('title', 'Intake')->firstOrFail();
    }

    public static function TaskInProgressStatusID()
    {
        return TaskStatus::where('name', 'in progress')->firstOrFail()->id;
    }

    public static function defaultTaskCountryMapping (){
        $default_task_country = array();
        $default_task_country[0] = ['id' => '1', 'title' => 'Attached'];
    }





}