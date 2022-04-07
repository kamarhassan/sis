<?php
use Illuminate\Database\Seeder;
use App\Models\Cours;
use App\Models\Grade;
use App\Models\level;


class CoursSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 5; $i++) {
            $delete = $faker->randomElement([0, 1]);
            $status = $faker->randomElement([1, 2, 3, 4, 5]);

            Cours::create([
                'startDate' =>  $faker->date('y-m-d', now()),
                'endDate' =>  $faker->date('y-m-d', now()),
                'maxStd' => random_int(0, 60),
                'note' => $faker->sentence(20),
                'status' => $status,
                'teachername' => $faker->name(),
                'teacherFee' => random_int(1000, 60000),
                'startTime' => $faker->time('H:i:s', now()),
                'endTime' => $faker->time('H:i:s', now()),
                'days' => 'Mon:Tues:Thir',
                'act_StartDa' => $faker->date('y-m-d', now()),
                'act_EndDa' => $faker->date('y-m-d', now()),
                'year' => $faker->date('y', now()),
                'deleted' => $delete,
                'grade_id' => Grade::inRandomOrder()->first()->id,
                'level_id' => level::inRandomOrder()->first()->id,
            ]);
        }
    }
}
