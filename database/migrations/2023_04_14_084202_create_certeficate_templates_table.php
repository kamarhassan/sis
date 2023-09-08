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
      Schema::create('certeficate_templates', function (Blueprint $table) {
         $table->id();
         $table->string('name');
         $table->string('background_image')->nullable();
         $table->longText('template')->nullable();
         $table->tinyInteger('isactive')->enum('isactive', [0, 1])->default(1)
            ->comment("1 =>  no, 0 =>  yes");
         $table->tinyInteger('availabletosearche')->enum('availabletosearche', [0, 1])->default(0)
            ->comment("0 =>  no, 1 =>  yes")->comment('is avilable to seachre by anyone');


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
      Schema::dropIfExists('certeficate_templates');
   }
};
