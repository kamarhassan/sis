<?php


use Illuminate\Support\Facades\Route;
use LaravelPWA\Http\Controllers\LaravelPWAController;
use Modules\Cms\Http\Controllers\Admin\FrontPageController;
use Modules\Cms\Http\Controllers\Admin\MenuBuilderController;

Route::group(
   [

      'prefix' => LaravelLocalization::setLocale() . '/admin/cms',
      'middleware' => ['auth:admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
   ],
   function () {

  
      Route::prefix('page-builder/')->middleware(['auth'])->group(function () {
         // Route::resource('pages', 'PageBuilderController')->except(['destroy', 'create']);
         Route::post('page/delete', 'PageBuilderController@destroy')->name('pages.destroy');
         Route::post('page/status', 'PageBuilderController@status')->name('pages.status');
         Route::get('page/design/{id}', 'PageBuilderController@design')->name('pages.design');
         Route::post('page/design/update/{id}', 'PageBuilderController@designUpdate')->name('pages.design.update');
         Route::get('snippet', 'PageBuilderController@affSnippet')->name('snippet');
         // Route::post('new-upload', 'ImageUploadController@upload')->name('pageBuilderImageUpload');
         Route::post('upload-image', 'PageBuilderController@upload_image')->name('pages.design.upload.image');
      });
     
   }

);