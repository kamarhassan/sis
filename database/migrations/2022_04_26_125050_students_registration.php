<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentsRegistration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentsRegistrations', function (Blueprint $table) {
            $table->id();
            //  $table->integer('sponsor')
            $table->tinyInteger ('isdiploma')->enum('sponsored', [0, 1])->default(0)
                ->comment("0 =>  no, 1 =>  yes");
                $table->string('notes')->nullable();
                $table->string('feesRequired')->nullable();
                $table->foreignId('cours_id')->constrained('courss');
                $table->foreignId('user_id')->constrained('users');
                // $table->foreignId('sponsorshipID')->default(-1)->constrained('sposorships');;

                $table->integer('sponsor_id')->unsigned()->nullable();
                $table->double('cours_fee_total')->nullable();
                $table->double('remaining')->nullable();
                // $table->foreign('sponsorshipID')->references('id')->on('sposorships');

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
        Schema::dropIfExists('cours_fees');
    }
}
