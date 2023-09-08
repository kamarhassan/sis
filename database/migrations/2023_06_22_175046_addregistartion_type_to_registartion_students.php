<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::table('studentsregistrations', function (Blueprint $table) {
         $table->json('teams_info')->after('feesRequired')->nullable()
            ->comment('it\'s for type of teams acount if type of registartoin is  online');
         $table->tinyInteger('registration_type')->after('feesRequired')->enum('teach_type', [0, 1])->nullable()
            ->comment('it\'s for type  of registartoin is  online or offline 0 is offline 1 it online');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::table('registartion_students', function (Blueprint $table) {
         //
      });
   }
};
