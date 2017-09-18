<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class OrganizationTableSeeder extends Seeder {

    public function run()
    {


        $organization = [
            [
                'name' => 'Dnet',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]
        ];

        if (DB::table('organizations')->insert($organization)) {

        }

    }

}