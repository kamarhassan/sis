<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade');
            $table->integer('order_id');
            $table->string('order_type');
            $table->text('description');
            $table->Integer('status')->enum('0','1')->nullable()->comment('null=> pending  0 => deny     1=>approved');
            $table->Integer('is_read')->enum('0','1')->default(1)->comment('0 =>  read     1=>unread');
            $table->Integer('delete')->enum('0','1')->default(1)->comment('0 => undeleted     1=>deleted ');
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
        Schema::dropIfExists('notification_admins');
    }
}
