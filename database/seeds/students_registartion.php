<?php

namespace Database\Seeders;

use App\Models\Cours;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class students_registartion extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      for ($i = 0; $i < 9000; $i++) {

         $rand = rand(1, 9);

         $date = Carbon::now()->subMonths($rand);

         DB::table('studentsRegistrations')->insert([
            'cours_id' => Cours::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'notes' => '',
            'feesRequired' => '',
            // 'sponsorshipID'=>-1,
            'created_at' =>  $date,
            'updated_at' =>  $date,
         ]);
      }
   }
}
