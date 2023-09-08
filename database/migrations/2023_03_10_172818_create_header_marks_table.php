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
      Schema::create('header_marks', function (Blueprint $table) {
         $table->id();
         $table->foreignId('cours_id')->constrained('courss');
         $table->foreignId('teacher_id')->constrained('admins');
         $table->json('marks')->nullable();
         $table->integer('total')->nullable();
         $table->integer('percent')->nullable();
         $table->tinyInteger ('status')->enum('status', [0, 1])->default(1)
         ->comment("0 =>  disabled, 1 =>  enabled");
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
      Schema::dropIfExists('header_marks');
   }
};
