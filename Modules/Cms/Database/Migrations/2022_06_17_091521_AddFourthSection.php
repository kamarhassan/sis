<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;
use Modules\FooterSetting\Entities\FooterSetting;
use Modules\FooterSetting\Entities\FooterWidget;

class AddFourthSection extends Migration
{
    public function up()
    {

        FooterSetting::withoutEvents(function () {
            $setting = new FooterSetting();
            $setting->key = 'footer_section_four_title';
            $setting->value = 'About Section';
            $setting->save();
            // UpdateGeneralSetting('footer_section_four_title', 'About Section');

            $sql = [
                'user_id' => 1,
                'category' => 4,
                'page' => '',
                'page_id' => 0,
                'section' => 4,
                'status' => 1,
                'is_static' => 1,

                'name' => 'Unlock Your Potential',
                'slug' => Str::slug('Unlock Your Potential'),
                'description' => '',
            ];
            FooterWidget::create($sql);
        });
    }

    public function down()
    {
        //
    }
}
