<?php

namespace Modules\Cms\Repositories;


use Modules\Cms\Entities\FooterSetting;

class FooterSettingRepository
{


   public function update($data, $id)
   {
//      dd($data);
      $setting = FooterSetting::where('key', $data['key'])->first();
      $setting->value = $data['setting_value'];

//        foreach ($data['value'] as $key => $value) {
//            $setting->setTranslation('value', $key, $value);
//        }
      $setting->save();
//        UpdateGeneralSetting($data['key'], $data['value']);
   }

   public function edit($id)
   {
      $footer = $this->footer->findOrFail($id);
      return $footer;
   }

   public function getAll()
   {
      return FooterSetting::all();
   }
}
