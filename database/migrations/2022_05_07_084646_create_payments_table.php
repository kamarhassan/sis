<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->float('amount')->comment('Amount of each fee');
            $table->float('paid_amount')->comment('Amount paid from each fee');
            $table->float('remaining')->comment('amount - paid amount');
            $table->foreignId('studentsRegistration_id')->constrained('studentsRegistrations')->onUpdate('cascade')->comment('from students registration table is it ***id***');
            $table->foreignId('cours_fee_id')->constrained('cours_fees')->onUpdate('cascade')->comment('from cours fees ***id***');
            $table->foreignId('receipt_id')->constrained('receipts')->onUpdate('cascade')->comment('from from receipt ***id***');
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
        Schema::dropIfExists('payments');
    }
}
