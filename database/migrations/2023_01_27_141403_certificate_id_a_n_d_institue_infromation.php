<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CertificateIdANDInstitueInfromation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courss', function (Blueprint $table) {
            $table->json('institue_information_id')->change();
            $table->json('certificate_id')->change();
            $table->renameColumn('certificate_id', 'categories_id');
            // $table->string('certificate_id')->nullable()->comment('array of ids of certficate');
          
            
            
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courss', function (Blueprint $table) {
            //
        });
    }
}
