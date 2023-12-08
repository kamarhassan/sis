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


     
      

      Schema::create('years', function (Blueprint $table) {
         $table->id();
         $table->string('year');
         $table->date('start');
         $table->date('end');
         $table->boolean('currentyear')->nullable();
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
      Schema::dropIfExists('years');
    }
};
