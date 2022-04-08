<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cours_fees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table ->integer('order');
            $table->integer('primary_price')->nullable();
            $table->integer('sponsored')->enum('sponsored',[0,1])->default(1)->comment("0 =>  not entry in fees cours  , 1 =>  is entry in fees cours   ");
         // $table->foreignId('cours_id')->constrained('levels')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('cours_fees');
    }
}
