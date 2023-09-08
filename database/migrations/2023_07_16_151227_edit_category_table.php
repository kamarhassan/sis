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
      Schema::table('categories', function (Blueprint $table) {
         $table->integer('total_hours')->after('duration')->nullable();
         $table->json('tag')->after('name')->nullable();
         $table->foreignId('grade_id')->after('name')->constrained('grades');
         $table->foreignId('level_id')->after('name')->constrained('levels');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      //
   }
};
