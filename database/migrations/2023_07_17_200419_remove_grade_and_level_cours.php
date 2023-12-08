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
       Schema::table('courss', function (Blueprint $table) {
          $table->renameColumn('categories_id', 'related_categories');
         //  $table->dropForeign(['grade_id', 'level_id']);
          $table->foreignId('categorie_id')->after('id')->constrained('categories');
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
