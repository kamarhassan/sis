<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class FrontendDynamicStyleColor extends Component
{

    public function render()
    {
        if (function_exists('SaasInstitute') && SaasInstitute() != null) {
            $institute_id=SaasInstitute()->id;
        }else{
             $institute_id=1;
        }
        if (function_exists('SaasDomain')){
            $domain =SaasDomain();
        }else{
            $domain='main';
        }
        $color = Cache::rememberForever('color_theme_'.$domain, function () use($institute_id) {
            return DB::table('themes')
                ->select(
                    'theme_customizes.primary_color',
                    'theme_customizes.secondary_color',
                    'theme_customizes.footer_background_color',
                    'theme_customizes.footer_headline_color',
                    'theme_customizes.footer_text_color',
                    'theme_customizes.footer_text_hover_color',
                )
                ->join('theme_customizes', 'themes.name', '=', 'theme_customizes.theme_name')
                ->where('theme_customizes.lms_id', '=',$institute_id)
                ->where('themes.is_active', '=', 1)
                ->where('theme_customizes.is_default', '=', 1)
                ->first();
        });
        return view(theme('components.frontend-dynamic-style-color'), compact('color'));
    }
}
