<?php

namespace Modules\Setting\Model;

// use App\Traits\Tenantable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
// use Modules\Localization\Entities\Language;

class GeneralSetting extends Model
{

   //  use Tenantable;

    protected $hidden = ['id', 'created_at', 'updated_at'];


    protected $guarded = [];

   //  public function language()
   //  {
   //      return $this->belongsTo(Language::class, 'language_id')->withDefault();
   //  }

    public function timezone()
    {
        return $this->belongsTo(TimeZone::class, 'time_zone_id')->withDefault();
    }

   //  public function currency()
   //  {
   //      return $this->belongsTo(Currency::class)->withDefault();
   //  }

    public function date_format()
    {
        return $this->belongsTo(DateFormat::class, 'date_format_id')->withDefault();
    }


    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            if (function_exists('SaasDomain')) {
                GenerateGeneralSetting(SaasDomain());
                Cache::forget('frontend_active_theme_'.SaasDomain());
            }

        });
        self::updated(function ($model) {
            if (function_exists('SaasDomain')) {
                GenerateGeneralSetting(SaasDomain());
                Cache::forget('frontend_active_theme_'.SaasDomain());

            }
        });
    }


}
