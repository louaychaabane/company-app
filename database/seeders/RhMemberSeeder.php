<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RhMember;
use Faker\Factory as Faker;

class RhMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();

        // Generate 10 RhMembers
        for ($i = 0; $i < 10; $i++) {
            RhMember::create([
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('louay'), 
            ]);
        }
    }
}
