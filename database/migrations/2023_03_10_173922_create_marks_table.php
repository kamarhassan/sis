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
      Schema::create('marks', function (Blueprint $table) {
         $table->id();
         $table->foreignId('header_mark_id')->constrained('header_marks');
         $table->foreignId('cours_id')->constrained('courss');
         $table->foreignId('user_id')->constrained('users');
         $table->json('std_marks')->nullable();
         $table->integer('total')->nullable();
         $table->integer('percent')->nullable();
         $table->float('average')->nullable();

         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('marks');
   }
};
