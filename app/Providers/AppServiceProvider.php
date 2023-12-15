<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
   /**
    * Register any application services.
    *
    * @return void
    */
   public function register()
   {
      //
   }

   /**
    * Bootstrap any application services.
    *
    * @return void
    */
   public function boot()
   {

      Schema::defaultStringLength(191);
      Paginator::defaultView('vendor.pagination.bootstrap-4');
      if (App::environment('production')) {
         URL::forceSchema('https');
      }
      // Paginator::defaultSimpleView('vendor.pagination.simple-tailwind');
   }
}
