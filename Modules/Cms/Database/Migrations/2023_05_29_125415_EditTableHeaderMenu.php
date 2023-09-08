<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('header_menus', function (Blueprint $table) {
//          `lms_id` int(11) NOT NULL DEFAULT 1,
          if (!Schema::hasColumn('header_menus', 'lms_id')) {
             $table->integer('lms_id')->default(1);
          }
          if (!Schema::hasColumn('header_menus', 'mega_menu')) {
             $table->tinyInteger('mega_menu')->default(0);
          }

          if (!Schema::hasColumn('header_menus', 'mega_menu_column')) {
             $table->integer('mega_menu_column')->default(2);
          }
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
