<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use phpDocumentor\Reflection\Types\This;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind('App\Repository\Cours\CoursInterface','App\Repository\Cours\CoursRepository');
       $this->app->bind('App\Repository\Fee_Type\Fee_TypeInterface','App\Repository\Fee_Type\Fee_typeRepository');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
