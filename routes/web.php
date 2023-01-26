<?php

use App\Http\Livewire\Count;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontEnd\IndexController;
use App\Http\Controllers\FrontEnd\CategoriesController;
use App\Http\Controllers\FrontEnd\CoursDetailController;
use App\Http\Controllers\FrontEnd\RegisterCoursController;
use App\Http\Controllers\FrontEnd\UserDashboradController;

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

Route::get('/', [IndexController::class, 'index'])->name('web.index');
Route::get('/home', [HomeController::class, 'index'])->name('web.home');

Auth::routes(['verify' => true]);
// Auth::routes();
Route::group(['prefix' => 'categorie'], function () {
              
    Route::get('/', [CategoriesController::class, 'index'])/*->middleware(['permission:edit certificate |create certificate |delete certificate']) */->name('admin.certificate.all');
    Route::get('/{categories_id}', [CategoriesController::class, 'show_categorie_details_by_id'])/*->middleware(['permission:edit certificate |create certificate |delete certificate']) */->name('show.categorie.details_by_id');
   
    //  Route::get('/new', [CertificateController::class, 'create'])->middleware(['permission:create certificate'])->name('admin.certificate.new');
    //  Route::post('store-certificate', [CertificateController::class, 'store_certificate'])->middleware(['permission:create certificate'])->name('admin.certificate.store.certificate');
    //  Route::post('delete-certificate', [CertificateController::class, 'delete_certificate'])->middleware(['permission:delete certificate'])->name('admin.certificate.delete.certificate');
    //  Route::get('edit/{id}', [CertificateController::class, 'edit_certificate'])->middleware(['permission:edit certificate'])->name('admin.certificate.edit.certificate');
    //  Route::post('store-edit-certificate', [CertificateController::class, 'save_edit_certificate'])->middleware(['permission:edit certificate'])->name('admin.certificate.save.edit.certificate');
 });
Route::get('dashboard', [UserDashboradController::class, 'index'])->middleware('verified')->name('web.dashboard');
Route::get('my-cours/{user_id}', [UserDashboradController::class, 'user_cours_reserved'])->middleware('verified')->name('web.user.cours');
Route::get('cours/{cours_name}/{coursid}', [CoursDetailController::class, 'cours_details'])->middleware('verified')->name('web.cours-details');
Route::post('delete', [RegisterCoursController::class, 'delete_cours_reserved'])->middleware('verified')->name('web.delete.cours.reserved');
Route::post('register-cours', [RegisterCoursController::class, 'RegisterCours'])->middleware('verified')->name('web.registerCours');
