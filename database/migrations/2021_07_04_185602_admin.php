<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Admin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('email', 191)->unique();
            $table->string('password');
            $table->string('passwordischanged')->default(0)->enum('0','1')->comment('1 => is changed 0 => not changed');
         //   $table->string('roles_name');
            // $table->tinyInteger('active')->enum('0','1','2')->comment('0 => disable   1=>active  2=> pending ' );
            $table->Integer('admin_status')->enum('0','1','2')->comment('1=>active 0 => inactive  2 =>pending');

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
        Schema::dropIfExists('admins');
    }
}
