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
            $table->string('days');
            $table->string('status', 50);
            // $table->string('teachername');
            $table->double('teacherFee');
            $table->time('startTime')->nullable();
            $table->time('endTime')->nullable();
            $table->string('act_StartDa');
            $table->string('act_EndDa');
            $table->string('year');
            $table->string('deleted')->enum('deleted', [0, 1])->default(1)->comment("0=>delete  1=>is active");
            $table->foreignId('teacher_id')->constrained('admins')->onDelete('cascade')->onUpdate('cascade')->comment('for teacher name');
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('level_id')->constrained('levels')->onDelete('cascade')->onUpdate('cascade');



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
