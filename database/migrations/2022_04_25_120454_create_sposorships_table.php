<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSposorshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsorships', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sponsor_id')->constrained('sponsors');
            $table->integer('cours_id');
            $table->integer('type');
            $table->double('discount')->comment('cours fee total')->nullable();
            $table->double('percent')->nullable();
            $table->integer('is_updated')->comment('null is new ')->nullable();
            $table->string('fee_sponsored')->comment('fee sponsored exam,....')->nullable();
            $table->string('note');

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
        Schema::dropIfExists('sposorships');
    }
}
