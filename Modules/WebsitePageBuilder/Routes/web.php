<?php

use Modules\Cms\Http\Controllers\FrontEnd\FrontPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
include('admin.php');
Route::prefix('websitepagebuilder')->group(function() {
   
    Route::get('/', 'WebsitePageBuilderController@index');
});
Route::get('page/{slug}', [FrontPageController::class, 'index'])->name('page.web.front.page.show.after.design');