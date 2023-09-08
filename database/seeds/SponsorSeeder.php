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
        DB::table('sponsors')->delete();
        $faker = \Faker\Factory::create();

        $type = [
            ['X'=>'جمعية' , 'Y'=> 'التعليم الديني'],
            ['X'=>'تعبئة تربوية' , 'Y'=> 'تعبئة تربوية'],
            ['X'=>'موسسة تعليمية' , 'Y'=> 'طفولة مبكرة']
        ];


        for ($i = 1; $i < 5; $i++) {
            $defaultpercent = $faker->randomElement([
                1,
                99
            ]);
            $name = $faker->name();
            $t = $faker->randomElement($type);
            Sponsor::create([
                'type' => $t['X'],
                'name' => $t['Y'],
                'budgetLimit' => rand(100000, 50000),
                'studentLimit' => rand(25, 200),
                'defaultpercent' => $defaultpercent
            ]);
        }
     
    }
}
