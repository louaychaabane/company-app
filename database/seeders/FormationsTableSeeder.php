<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Formation;
use Faker\Factory as Faker;

class FormationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $specialiteOptions = ['Informatique', 'Electricité', 'Chimie', 'Finance'];

        for ($i = 0; $i < 15; $i++) {
            Formation::create([
                'title' => $faker->sentence(3),
                'start_date' => $faker->dateTimeBetween('now', '+6 months')->format('Y-m-d'),
                'trainer' => $faker->firstName . ' ' . $faker->lastName,
                'hours' => $faker->numberBetween(2, 4),
                'specialite' => $faker->randomElement($specialiteOptions),
            ]);
        }
    }
}
