<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notification_admins', function (Blueprint $table) {
           
            $table->tinyInteger('teach_type')->enum('teach_type', [0, 1])->nullable()->comment('it\'s for type of registartion online or offline ' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notification_admin', function (Blueprint $table) {
            //
        });
    }
};
