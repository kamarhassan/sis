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
       Schema::table('certificates', function (Blueprint $table) {
          $table->renameColumn('grade_id', 'categorie_id');
          $table->dropColumn('levels');
//          $table->foreignId('categorie_id')->after('id')->constrained('categories');
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
