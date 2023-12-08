<?php

namespace Database\Seeders;

use App\Models\Years;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class YearSedeer extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Years::create([
         'year'   => '2023-2024',
         'start'   => '2023-12-02',
         'end'   => '2024-12-02',
         'currentyear'   => 1,

      ]);
   }
}
