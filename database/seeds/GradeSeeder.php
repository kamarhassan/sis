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
        Grade::create(['Notes' => '','grade' => 'Laravel 8']);
        Grade::create(['Notes' => '','grade' => 'Php ']);
        Grade::create(['Notes' => '','grade' => 'Python']);
        Grade::create(['Notes' => '','grade' => '.net C#']);
        Grade::create(['Notes' => '','grade' => 'Html']);
        Grade::create(['Notes' => '','grade' => 'Css']);
        Grade::create(['Notes' => '','grade' => 'JavaScript']);


    }
}
