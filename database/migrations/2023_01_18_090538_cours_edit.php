<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CoursEdit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courss', function (Blueprint $table) {
            $table->dropColumn('teacherFee');
            $table->string('certificate_id')->nullable()->comment('array of ids of certficate');
            $table->tinyInteger ('teacher_can_add_students')->enum('teacher_can_add_students', [0, 1])->default(0)
            ->comment("0 =>  disabled, 1 =>  enabled");
            $table->integer('institue_information_id')->nullable()->comment('city of institue if cours not online');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courss', function (Blueprint $table) {
            //
        });
    }
}
