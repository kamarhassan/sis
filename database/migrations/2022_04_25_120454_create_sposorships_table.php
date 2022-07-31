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
        Schema::create('sposorships', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sponsorID')->constrained('sponsors') ->onUpdate('cascade');;
            $table->integer('type');
            $table->float('amount');
            $table->float('percent')->default(000);
            $table->string  ('note') ;

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
