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
      Schema::create('students_certificate_barcodes', function (Blueprint $table) {
         $table->id();
         $table->foreignId('studentsRegistration_id')->constrained('studentsRegistrations')->comment('from students registration table is it ***id***');
         $table->bigInteger('code_number');
         $table->bigInteger('certificate_id')->nullable();
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
      Schema::dropIfExists('students_certificate_barcodes');
   }
};
