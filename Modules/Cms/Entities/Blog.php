<?php

namespace Modules\Cms\Entities;

use App\User;
use Carbon\Carbon;
use App\Traits\Tenantable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
// use Modules\Org\Entities\OrgBlogBranch;
// use Modules\Org\Entities\OrgBlogPosition;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Blog extends Model
{

   //  use Tenantable;

    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at', 'authored_date_time'];
   
    protected $cast = [
      'tags' => 'array',
      'image' => 'array'
   ];
   //  use HasTranslations;

   //  public $translatable = ['title', 'description'];

   protected function tags(): Attribute
   {
       return Attribute::make(
           set: fn ($value) => json_encode( explode(',', $value)  ),
           get: fn ($value) => json_decode($value),
       );
   }
   protected function image(): Attribute
   {
       return Attribute::make(
           set: fn ($value) => json_encode($value),
           get: fn ($value) => json_decode($value),
       );
   }



    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function blogcategory()
    {
        return $this->belongsTo(BlogCategory::class,'category_id','id');
    }


    public function comments()
    {
        return $this->hasMany(BlogComment::class)->where('status', 1)->orderByDesc('id');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->updateingDateTime($model);
        });
        self::updating(function ($model) {
            $model->updateingDateTime($model);
        });
        self::created(function ($model) {
            // saasPlanManagement('blog_post', 'create');
            if (function_exists('clearAllLangCache')) {
               //  clearAllLangCache('BlogPosList_');
            }
        });
        self::updated(function ($model) {
            if (function_exists('clearAllLangCache')) {
               //  clearAllLangCache('BlogPosList_');
            }
        });
        self::deleted(function ($model) {
            // saasPlanManagement('blog_post', 'delete');
            if (function_exists('clearAllLangCache')) {
               //  clearAllLangCache('BlogPosList_');
            }
        });
    }

    public function branches()
    {
        return $this->hasMany(OrgBlogBranch::class, 'blog_id');
    }

    public function positions()
    {
        return $this->hasMany(OrgBlogPosition::class, 'blog_id');
    }

    public function updateingDateTime($model): void
    {

        try {
            $dateTime = Carbon::parse($model->authored_date . ' ' . $model->authored_time);
        } catch (\Exception $exception) {
            $dateTime = null;
        }

        $model->authored_date_time = $dateTime;
    }

    public function userRead()
    {
        return $this->hasOne(UserBlog::class, 'blog_id')->where('user_id', Auth::id());
    }
}
