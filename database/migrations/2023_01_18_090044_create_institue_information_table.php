<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitueInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institue_informations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('name of institue');
            $table->string('phone')->nullable()->comment('phone of institue');
            $table->string('email')->nullable()->comment('email of institue');
            $table->string('city')->nullable()->comment('cityof institue');
            $table->string('building')->nullable()->comment('building of institue');
            $table->string('googlemaplocation')->nullable()->comment('google map location of institue');
        
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
        Schema::dropIfExists('institue_information');
    }
}
