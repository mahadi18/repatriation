<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class CountryTableSeeder extends Seeder {

    public function run()
    {

        DB::table('countries')->truncate();

        $countries = [
            [
                'id' => 1,
                'name' => 'Bangladesh',
                'code' => 'BD',
                'latitude'=>'23.6850',
                'longitude'=>'90.3563',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ],
            [
                'id' => 2,
                'name' => 'India',
                'code' => 'IN',
                'latitude'=>'22.855170',
                'longitude'=>'79.299316',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ],
            [
                'id' => 3,
                'name' => 'Nepal',
                'code' => 'NP',
                'latitude'=>'28.394857',
                'longitude'=>'84.124008',
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]
        ];

        if (DB::table('countries')->insert($countries)) {
            $this->command->info("\n::Countries table seeded.\n");
        } else {
            $this->command->info("\n::Failed to seed Countries table.\n");
        }

    }

}
