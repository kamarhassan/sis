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
        Schema::create('email_sents', function (Blueprint $table) {
            $table->id();
            $table->string('contact_us_id')->nullable();
            $table->string('email')->nullable();
            $table->string('email_subject')->nullable();
            $table->string('email_description')->nullable();
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
        Schema::dropIfExists('email_sents');
    }
};
