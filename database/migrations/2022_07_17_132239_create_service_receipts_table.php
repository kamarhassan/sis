<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_receipts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('currencies_id')->constrained('currencies')->onDelete('cascade')->onUpdate('cascade')->comment('it is the currency of payment ');
            $table->foreignId('service_currency_id')->constrained('currencies')->onDelete('cascade')->onUpdate('cascade')->comment('it is the currency of cours');
           // $table->foreignId('cours_fee_id')->constrained('cours_fees')->onDelete('cascade')->onUpdate('cascade')->comment('from cours fees ***id***');
            $table->float('amount')->default(0);
            $table->float('other_amount')->default(0);
            $table->float('rate_exchange')->default(1);
            $table->float('amount_total');
            $table->integer('transaction_id')->nullable()->default(null);
            $table->string('description')->nullable()->default(null)->comment('');
            $table->string('payType')->nullable()->enum('cash', 'check')->default('cash');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_service_id')->constrained('user_services')->onDelete('cascade')->onUpdate('cascade')
            ->comment('from user service  table is it ***id***');

            $table->bigInteger('checkNum')->nullable()->default(null);
            $table->tinyInteger('deleted')->enum('sponsored', [0, 1])->default(1)->comment("1 =>no, 0 =>yes");




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
        Schema::dropIfExists('service_receipts');
    }
}
