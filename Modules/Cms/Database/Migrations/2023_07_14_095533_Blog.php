<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class Blog extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('blogs', function (Blueprint $table) {
         $table->increments('id');
         $table->unsignedInteger('user_id');
         $table->string("title")->nullable();
         $table->string('slug');
         $table->longText('description')->nullable();
         $table->boolean('status')->default(1);
         $table->json('image')->nullable();
         $table->json('thumbnail')->nullable();
         $table->integer('viewed')->default(0);
         $table->string('authored_date')->nullable();
         $table->timestamp('authored_date_time')->nullable();
         $table->tinyInteger('position_audience')->default(1)->comment('1=public,2=Specify');
         
         $table->text('authored_time')->nullable();
         $table->tinyInteger('audience')->default(1)->comment('1=public,2=Specify');
         $table->json('tags')->nullable();
         $table->integer('category_id')->nullable()->default(0);
     

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
      Schema::dropIfExists('blogs');
   }
}
