<?php

use App\Models\CoursFee;
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

        CoursFee::create(['name' => 'Registration Fee','order' => 1 ]);
        CoursFee::create(['name' => 'Course Fees','order' => 1 ]);
        CoursFee::create(['name' => 'Book','order' => 1 ]);
        CoursFee::create(['name' => 'Exam','order' => 1 ]);

    }
}
