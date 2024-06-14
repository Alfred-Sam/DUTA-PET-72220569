<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class movieappSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i=1;$i<=100;$i++)
        {
            DB::table('movieapp')->insert([
                'nama' => $faker->sentence(),
                'gender' => $faker->word(),
                'year' => $faker->year(),
                'photo' => $faker->url(),
            ]);
        }
        
        
    }
}
