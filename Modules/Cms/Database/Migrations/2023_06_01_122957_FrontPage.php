<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
   {
      Schema::create('front_pages', function (Blueprint $table) {
         $table->id();
         $table->text('name')->nullable();
         $table->text('title')->nullable();
         $table->text('sub_title')->nullable();
         $table->longText('details')->nullable();
         $table->string('slug')->unique();
         $table->tinyInteger('status')->default(1);
         $table->string('url_storage')->nullable();
         $table->tinyInteger('is_static')->default(1);
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
      Schema::dropIfExists('front_pages');
   }
};
