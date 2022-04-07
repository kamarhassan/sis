<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('currency');
            $table->string('abbr');
            $table->string('Country');
            $table->string('symbol');
            // $table->bigInteger('rate')->default(1)->comment("calculate rate by $");
            $table->string('active')->enum('status',[0,1])->comment("0=>inactive, 1 => active");
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
        Schema::dropIfExists('currencies');
    }
}
