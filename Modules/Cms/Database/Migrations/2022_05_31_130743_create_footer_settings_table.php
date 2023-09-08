<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFooterSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('footer_settings', function (Blueprint $table) {
            $table->id();
            $table->text('key');
            $table->longText('value')->nullable();
            $table->timestamps();
        });

        $sql = [
            [
                'key' => 'footer_copy_right',
                'value' => 'footer_copy_right'
            ],
            [
                'key' => 'footer_about_title',
                'value' => 'footer_about_title'
            ],
            [
                'key' => 'footer_about_description',
                'value' => 'footer_about_description'
            ],
            [
                'key' => 'footer_section_one_title',
                'value' => 'footer_section_one_title'
            ], [
                'key' => 'footer_section_two_title',
                'value' => 'footer_section_two_title'
            ], [
                'key' => 'footer_section_three_title',
                'value' => 'footer_section_three_title'
            ],
        ];


      //   foreach ($sql as $q) {
      //       $setting = new \Modules\FooterSetting\Entities\FooterSetting();
      //       $setting->key = $q['key'];
      //       $setting->value = $this->getSettingValue($q['key']);
      //       $setting->save();

      //   }


    }

    public function down()
    {
        Schema::dropIfExists('footer_settings');
    }

   //  public function getSettingValue($key)
   //  {
   //      $setting = \Modules\Setting\Model\GeneralSetting::where('key', $key)->first();
   //      return $setting ? $setting->value : '';
   //  }
}
