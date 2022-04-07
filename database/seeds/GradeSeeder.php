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
        Grade::create(['Notes' => '','Name' => 'photoshop']);
        Grade::create(['Notes' => '','Name' => 'English']);
        Grade::create(['Notes' => '','Name' => 'German']);
        Grade::create(['Notes' => '','Name' => 'Spanish']);
        Grade::create(['Notes' => '','Name' => 'Franshe']);


    }
}
