<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class UpdateFooterSettingTableTranslateable extends Migration
{

    public function up()
    {

        Schema::table('footer_widgets', function($table){
            $table->longText("name")->nullable()->change();
        });
//
//        DB::statement('ALTER TABLE `footer_widgets`
//    CHANGE `name` `name` LONGTEXT  NULL DEFAULT NULL;');

        $lang_code = 'en';
        $table_name = 'footer_widgets';

        $rows = DB::table($table_name)->get();
        foreach ($rows as $row) {
            $pos = strpos($row->name, '{"');
            if ($pos === false) {
                DB::table($table_name)->where('id', $row->id)->update([
                    'name' => '{"' . $lang_code . '":"' . $row->name . '"}',
                ]);
            }
        }
    }

    public function down()
    {
        //
    }
}
