<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('acount_id')->random_int();
            $table->string('name');
            $table->string('midName');
            $table->string('LastName');
            $table->string('email', 191)->unique();
            $table->string('password');
            $table->string('MotherName');
            $table->string('salut')->enum("Mrs","Mr","Ms");
            // $table->string('fullname');
            $table->Date('birthday');
            $table->string('birthday_id_place')->comment('place of birthday');
            $table->string('gender')->enum('male','female');
            $table->bigInteger('identity_number')->comment('rakem lhawiye');
            $table->string('identity_type');
            $table->integer('segel')->comment('segel number');
            $table->integer('segel_place_id')->comment('place of segel');
            $table->string('nationality')->comment('nationality of user');
            $table->integer('address_id');
            $table->string('photo');
            $table->string('work_type')->comment('type of job for worker');
            $table->string('work_address_id')->comment('address of job for worker');
            $table->tinyInteger('user_status',4)->enum('0','1','2')->comment('1=>active 0 => inactive  2 =>pending');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
