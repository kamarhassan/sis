<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('currencies_id')->constrained('currencies')->onDelete('cascade')->onUpdate('cascade');
           // $table->foreignId('cours_fee_id')->constrained('cours_fees')->onDelete('cascade')->onUpdate('cascade')->comment('from cours fees ***id***');
            $table->float('amount')->default(0);
            $table->float('other_amount')->default(0);
            $table->float('rate_exchange')->default(1);
            $table->float('amount_total');
            $table->integer('transaction_id')->nullable()->default(null);
            $table->string('description')->nullable()->default(null)->comment('ma3lomet l cours Level ,grade ,user name');
            $table->string('payType')->nullable()->enum('cash', 'check')->default('cash');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('studentsRegistration_id')->constrained('studentsRegistrations')->onDelete('cascade')->onUpdate('cascade')
            ->comment('from students registration table is it ***id***');

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
        Schema::dropIfExists('receipts');
    }
}
