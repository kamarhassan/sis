<?php

use App\Models\Sponsor;
use App\Models\Sposorship;
use Illuminate\Database\Seeder;

class SposorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i < 5; $i++) {
            Sposorship::create([
                'sponsorID' => Sponsor::inRandomOrder()->first()->id,
                'type' => -1,
                'amount' => rand(100000,500000),
                'note' => $faker->text(150),
                'percent' => 30,
            ]);
        }
        //         type
        // name
        // blocked
        // budgetLimit
        // studentLimit
        // defaultpercent
    }
}
