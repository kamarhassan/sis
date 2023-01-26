<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_id')->nullable()->comment('array of certificate ids');
            $table->string('name')->comment('group of cours');
            $table->text('shorte_description')->nullable()->comment('group of cours');
            $table->text('description')->nullable();
            $table->text('details')->nullable();
            $table->text('prerequests')->nullable()->comment('what is you need to get this cours');
            $table->text('requireKnwoledge')->nullable()->comment('what is your Knwoledge to get this cours');
            $table->string('attache')->nullable()->comment('pdf to download');
            $table->string('global_image')->nullable()->comment('pic of cours');
            $table->text('callery')->nullable()->comment('array content image of cours');
            $table->string('url_vid_imbeded')->nullable()->comment('url of video imbede');
            $table->tinyInteger ('status')->enum('status', [0, 1])->default(1)
            ->comment("0 =>  disabled, 1 =>  enabled");
            $table->text('target_students')->nullable();
            $table->integer('duration')->nullable()->comment('nb of hours');
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
        Schema::dropIfExists('gategories');
    }
}
