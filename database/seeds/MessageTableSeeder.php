<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class MessageTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();

        // TestDummy::times(20)->create('App\Post');

        for ($i=0;$i<100;$i++) {

            DB::table('messages')->insert([
                'subject' => $faker->sentence($nbWords = 6),  // 'Sit vitae voluptas sint non voluptates.'
                'sender' => $faker->numberBetween($min = 1, $max = 20), // 17
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);

        }

        $this->command->info("\n::Messages table seeded.\n");
    }

}