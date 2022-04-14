<?php



use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  DB::table('grades')->delete();
        Grade::create(['Notes' => '','grade' => 'photoshop']);
        Grade::create(['Notes' => '','grade' => 'English']);
        Grade::create(['Notes' => '','grade' => 'German']);
        Grade::create(['Notes' => '','grade' => 'Spanish']);
        Grade::create(['Notes' => '','grade' => 'Franshe']);


    }
}
