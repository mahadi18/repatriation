<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DocTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
//        $faker->seed(1234);

        for ($i=0;$i<10;$i++) {

            DB::table('doc_types')->insert([
                'name' => $faker->name,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);

        }

        $this->command->info("\n::Doc Types table seeded.\n");

    }
}
