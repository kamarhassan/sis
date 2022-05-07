<?php

use App\Models\Sponsor;

use Illuminate\Database\Seeder;


class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        $faker = \Faker\Factory::create();


        for($i=1;$i<5;$i++){
            $defaultpercent = $faker->randomElement([10, 20]);
            $name = $faker->name();
            Sponsor::create([
                'type'=>'tt',
                'name'=>$name,
                'budgetLimit'=>rand(100000,50000),
                'studentLimit'=>rand(25,200),
                'defaultpercent'=>$defaultpercent
            ]);
        }
        // type
        // name
        // blocked
        // budgetLimit
        // studentLimit
        // defaultpercent
    }
}
