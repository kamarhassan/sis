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
            $table->string('name');
            $table->string('midName');
            $table->string('LastName');
            $table->string('email', 191)->unique();
            $table->string('password');
            $table->string('MotherName');
            $table->string('salut')->enum("Mrs","Mr","Ms");
            $table->Date('birthday');
            $table->string('birthday_id_place')->comment('place of birthday');
            $table->string('gender')->enum('male','female');
            $table->bigInteger('identity_number')->nullable()->comment('rakem lhawiye');
            $table->string('identity_type')->nullable();
            $table->integer('segel')->nullable()->comment('segel number');
            $table->integer('segel_place_id')->nullable()->comment('place of segel');
            $table->string('nationality')->nullable()->comment('nationality of user');
            $table->integer('address_id')->nullable();
            $table->string('photo')->nullable();
            $table->string('work_type')->nullable()->comment('type of job for worker');
            $table->string('work_address_id')->nullable()->comment('address of job for worker');
             $table->Integer('user_status')->default(0)->enum('user_status', ['0','1','2'])->comment('0 => inaproved   1=>approved   2 =>blocked');
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
