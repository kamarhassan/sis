<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('script');
            $table->string('native');
            $table->string('regional');
            $table->string('country')->nullable();
            $table->string('code');
            $table->enum('direction', ['rtl', 'ltr']);
            $table->boolean('active')->default(false)->comment = '1 is active 0 is inactive'; //


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
        Schema::dropIfExists('languages');
    }
}
