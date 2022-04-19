<?php

use App\Models\Nationalitie;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
        {

        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 15; $i++) {
            $gender = $faker->randomElement(['male', 'female']);
            $salut = $faker->randomElement(["Mrs","Mr","Ms"]);
            User::create([
                // 'acount_id' =>random_int(1,500),
                'name' =>    $faker->name(),
                'midName' =>   $faker->name(),
                'LastName' =>    $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => bcrypt('123456789'),
                'MotherName' =>    $faker->name(),
                'salut' =>  $salut,
                'birthday' =>    $faker->date('y-m-d',now()) ,  // Carbon::create($year, $month, $day, 0, 0, 0),
                'birthday_id_place' =>random_int(1, 50),
                'gender' => $gender,
                'identity_number' =>  random_int(1, 50),
                'identity_type' => Str::random(5),
                'segel' => random_int(1, 50),
                'segel_place_id'=>random_int(1, 50),
                'nationality' => Nationalitie::inRandomOrder()->first()->id,
                'address_id' =>  random_int(1, 50),
                'photo' => Str::random(5),
                'work_type' => Str::random(5),
                'work_address_id' =>  random_int(1, 50),
                'status' => 1,
            ]);
        }
    }
}
