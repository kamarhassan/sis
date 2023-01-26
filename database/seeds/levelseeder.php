<?php



use App\Models\Level;
use Illuminate\Database\Seeder;

class levelseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // DB::table('levels')->delete();
        Level::create(['level' => 'level 1']);
        Level::create(['level' => 'level 2']);
        Level::create(['level' => 'level 3']);
        Level::create(['level' => 'level 4']);
        Level::create(['level' => 'level 5']);
        Level::create(['level' => 'level 6']);
        Level::create(['level' => 'level 7']);
        Level::create(['level' => 'level 8']);
        Level::create(['level' => 'level 9']);
        Level::create(['level' => 'level 10']);
        Level::create(['level' => 'level 11']);
        Level::create(['level' => 'level 12']);
        Level::create(['level' => 'level 13']);
        Level::create(['level' => 'level 14']);
        Level::create(['level' => 'level 15']);
    }
}
