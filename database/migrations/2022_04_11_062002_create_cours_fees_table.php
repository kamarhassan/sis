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
            $table->decimal('value');
            // $table->integer('currencies_id');
            // $table->integer('primary_price')->nullable();
            // $table->integer('sponsored')->enum('sponsored', [0, 1])->default(1)->comment("0 =>  not entry in fees cours  , 1 =>  is entry in fees cours   ");
            $table->foreignId('currencies_id')->constrained('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('cours_id')->constrained('courss')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('fee_types_id')->constrained('fee_types')->onDelete('cascade')->onUpdate('cascade');
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
