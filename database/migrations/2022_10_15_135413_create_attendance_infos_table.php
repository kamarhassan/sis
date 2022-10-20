<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cours_id')->constrained('courss');
            $table->foreignId('teacher_id')->constrained('admins')->comment('for teacher name');
            $table->integer('total_hours');
            $table->date('date');
            $table->enum('status', [1, 0])->comment('1=>  active can edit attenance  ,   0=>  active can\'t edit attenance  ');
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
        Schema::dropIfExists('attendance_infos');
    }
}
