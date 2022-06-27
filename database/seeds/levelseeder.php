<?php



use App\Models\level;
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
        level::create(['level' => 'level 1']);
        level::create(['level' => 'level 2']);
        level::create(['level' => 'level 3']);
        level::create(['level' => 'level 4']);
        level::create(['level' => 'level 5']);
        level::create(['level' => 'level 6']);
        level::create(['level' => 'level 7']);
        level::create(['level' => 'level 8']);
        level::create(['level' => 'level 9']);
        level::create(['level' => 'level 10']);
        level::create(['level' => 'level 11']);
        level::create(['level' => 'level 12']);
        level::create(['level' => 'level 13']);
        level::create(['level' => 'level 14']);
        level::create(['level' => 'level 15']);
    }
}
