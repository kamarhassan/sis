<?php

use App\Models\Cours;
use App\Models\Grade;
use App\Models\level;
use App\Models\Admin;
use Illuminate\Database\Seeder;

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
        for ($i = 0; $i < 15; $i++) {
            $delete = $faker->randomElement([0, 1]);
            $status = $faker->randomElement(['open','closed','postopen','canceled']);
          $date  =$faker->date(now());
        //   $teacher = Admin::role('teacher')->get();
            Cours::create([
                'startDate' =>$date,
                'endDate' =>$date,
                'maxStd' =>random_int(0, 60),
                'status' => $status,
                // 'teachername' =>$faker->name(),
                'teacherFee' =>random_int(1000, 60000),
                'startTime' =>$faker->time('H:i:s', now()),
                'endTime' =>$faker->time('H:i:s', now()),
                'days' =>'1;2;5;6',
                'act_StartDa' =>$date,
                'act_EndDa' =>$date,
                'year' =>current_school_year(),
                'teacher_id' => Admin::inRandomOrder()->first()->id,
                'grade_id' =>Grade::inRandomOrder()->first()->id,
                'level_id' =>Level::inRandomOrder()->first()->id,
                // 'grade' =>Grade::inRandomOrder()->first()->name,
                // 'level' =>Level::inRandomOrder()->first()->name,
            ]);
        }
    }
}
