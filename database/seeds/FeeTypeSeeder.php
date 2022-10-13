<?php
use Illuminate\Database\Seeder;
use App\Models\CoursFee;
use App\Models\Fee_type;

class FeeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fee_type::create(['fee' => 'Registration Fee','order' => 1 ]);
        Fee_type::create(['fee' => 'Course Fees','order' => 2 ]);
        Fee_type::create(['fee' => 'Book','order' => 3]);
        Fee_type::create(['fee' => 'Exam','order' => 4 ]);
    }
}
