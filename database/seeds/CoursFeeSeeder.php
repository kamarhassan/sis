<?php

use App\Models\Cours;
use App\Models\CoursFee;
use App\Models\Currency;
use App\Models\fee_type;
use Illuminate\Database\Seeder;

class CoursFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 50; $i++) {
            // $date = $faker->date();
            CoursFee::create([
                'value' => random_int(1000, 60000),
                'currencies_id' => Currency::inRandomOrder()->first()->id,
                'cours_id' =>Cours::inRandomOrder()->first()->id,
                'fee_types_id' => fee_type::inRandomOrder()->first()->id,

            ]);

        }
    }
}
