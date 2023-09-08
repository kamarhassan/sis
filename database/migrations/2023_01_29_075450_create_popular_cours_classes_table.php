<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopularCoursClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popular_cours_classes', function (Blueprint $table) {
            $table->id();
            $table->integer('popular_id');
            $table->tinyInteger ('type')->enum('status', [0, 1])->default(1)
            ->comment("0 =>  cours, 1 =>  category");
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
        Schema::dropIfExists('popular_cours_classes');
    }
}
