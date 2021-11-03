<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        $faker = Faker::create();

        $gender = $faker->randomElement(['male', 'female']);
       
    	foreach (range(1,200) as $index) {
            DB::table('guides')->insert([
                'title' => $faker->name($gender),
                'category' => $faker->paragraph(1),
                'description' => $faker->paragraph(3),
                'content' => $faker->paragraph(4),
                'UserID' => $faker->numberBetween(1,10)
            ]);
        }
    }
}
