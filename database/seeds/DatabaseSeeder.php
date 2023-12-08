<?php


use Illuminate\Database\Seeder;
use Database\Seeders\students_registartion;

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
        $this->call(\Lwwcas\LaravelCountries\Database\Seeders\LcDatabaseSeeder::class); 
        /**
         * $this->call(\Lwwcas\LaravelCountries\Database\Seeders\LcDatabaseSeeder::class); 
         * to add the call country list 
         */
        $this->call(AdminSeeder::class);
        $this->call(languageSeeder::class);
        $this->call(CurrencySeeder::class);
         $this->call(\Status_of_coursSeed::class);
         // $this->call(YearSedeer::class);
        
         // $this->call(GradeSeeder::class);
        // $this->call(levelseeder::class);
            //   $this->call(NationalitieSeeder::class);
      //   $this->call(UserSeeder::class);
        // //   $this->call(\CoursSedeer::class);
        // $this->call(\FeeTypeSeeder::class);
        // //     //  $this->call(\CoursFeeSeeder::class);
         //   $this->call(students_registartion::class);
        // $this->call(\SponsorSeeder::class);
        // //     // //// $this->call(\SposorshipSeeder::class);
        // //     // //// $this->call(\ReceiptSedder::class);
        // //     // //// $this->call(\paymentSeeder::class);
        // $this->call(\ServiceSeeder::class);
    }
}
