<?php


use Illuminate\Database\Seeder;

// use UserSeed;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(languageSeeder::class);
        $this->call(levelseeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(NationalitieSeeder::class);
        $this->call(UserSeeder::class);
       
        $this->call(\CoursSedeer::class);
        $this->call(\Status_of_coursSeed::class);
        $this->call(\FeeTypeSeeder::class);
        // $this->call(\CoursFeeSeeder::class);

    }
}
