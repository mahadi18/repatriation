<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class TaskStatusTableSeeder extends Seeder {

    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
       /* DB::table('task_statuses')->truncate();*/
        //insert some dummy records
        DB::table('task_statuses')->insert(array(
            array('name'=>'New'),
            array('name'=>'In Progress'),
            array('name'=>'Skip'),
            array('name'=>'Complete'),
        ));
    }

}