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
        level::create(['name' => 'Elementary level 1']);
        level::create(['name' => 'Elementary level 1']);
        level::create(['name' => 'Elementary level 2']);
        level::create(['name' => 'Elementary level 3']);
        level::create(['name' => 'Elementary level 4']);
        level::create(['name' => 'Elementary level 5']);
        level::create(['name' => 'Elementary level 6']);
        level::create(['name' => 'Elementary level 7']);
        level::create(['name' => 'Elementary level 8']);
        level::create(['name' => 'Elementary level 9']);
        level::create(['name' => 'Elementary level 10']);
        level::create(['name' => 'Elementary level 11']);
        level::create(['name' => 'Elementary level 12']);
        level::create(['name' => 'Elementary level 13']);
        level::create(['name' => 'Elementary level 14']);
        level::create(['name' => 'Elementary level 15']);
    }
}
