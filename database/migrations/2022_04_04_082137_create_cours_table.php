<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courss', function (Blueprint $table) {
            $table->id();
        //    $table->string('grade');
        //    $table->string('level');
            $table->date('startDate');
            $table->date('endDate');
            $table->integer('maxStd')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('total_hours')->nullable();
            $table->string('days');
            $table->string('status', 50);
            $table->text('description');
            $table->double('teacherFee');
            $table->time('startTime')->nullable();
            $table->time('endTime')->nullable();
            $table->date('act_StartDa');
            $table->date('act_EndDa');
            $table->string('year');
            $table->foreignId('currencies_id')->constrained('currencies');
            $table->string('deleted')->enum('deleted', [0, 1])->default(1)->comment("0=>delete  1=>is active");
            $table->foreignId('teacher_id')->constrained('admins')->comment('for teacher name');
            // $table->foreignId('grade_id')->constrained('grades');
            // $table->foreignId('level_id')->constrained('levels');



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
        Schema::dropIfExists('cours');
    }
}
