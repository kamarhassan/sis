<?php

use App\Http\Controllers\Admin\CoursController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\loginController;
use App\Http\Controllers\Admin\SuperviserController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\User\UserController;
use App\Http\Livewire\Admin\Grade\AddGrade;
// use App\Http\Livewire\P;

// Route::get('add', [SuperviserController::class, 'create'])->name('admin.supervisor.add');


// define ('PAGINATION_COUNT',10);
Route::group(
    [
        'namespace' => 'Admin',
        'prefix' => LaravelLocalization::setLocale() . '/admin',
        'middleware' => ['guest:admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('login', [loginController::class, 'getlogin'])->name('get.admin.login');
        Route::post('login', [loginController::class, 'login'])->name('admin.login');
        Route::get('logout', [loginController::class, 'logout'])->name('get.admin.logout');
    }
);





Route::group([
    'prefix' => LaravelLocalization::setLocale() . '/admin',
    'middleware' => ['auth:admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']

], function () {



    Route::get('logout', [loginController::class, 'logout'])->name('get.admin.logout');

    // Route::resource('products','ProductController');
    Route::get('/', 'DashboardController@index')->name('admin.dashborad');
    ################################### Begin Language Routes #################################################
    Route::group(['prefix' => 'language'], function () {
        Route::get('/', [LanguageController::class, 'index'])->name('admin.language');

        Route::get('create', [LanguageController::class, 'create'])->name('admin.language.create');
        Route::post('store', [LanguageController::class, 'store'])->name('admin.language.store');

        Route::get('edit/{id}', [LanguageController::class, 'edit'])->name('admin.language.edit');
        Route::post('update/{id}', [LanguageController::class, 'update'])->name('admin.language.update');

        // Route::post('delete', [LanguageController::class, 'delete'])->name('admin.language.delete');
        // Route::post('delete',[LanguageController::class ,'delete'])->name('admin.language.delete');
    });
    ################################### End Language Routes ###################################################









    ################################### Begin Settings Routes #################################################
    Route::group(['prefix' => 'Setting'], function () {
        // Setting/add_grades
        // Route::get('/', [UserController::class, 'index'])->name('admin.users.all');
        // Route::view('/add_grades', 'livewire/Admin/Grade/Addgrade'/*AddGrade::class*/)->name('admin.grades.add');

        ###########################  for grades setting
        Route::get('add_grades', [GradeController::class, 'create'])->name('admin.grades.add');
        Route::post('grade_store',  [GradeController::class, 'store'])->name('admin.grades.store');
        Route::post('grade_delete', [GradeController::class, 'delete'])->name('admin.grades.delete');
        Route::post('grade_update', [GradeController::class, 'update'])->name('admin.grades.update');

        ###########################  for level setting
        Route::get('add_levels', [LevelController::class, 'create'])->name('admin.level.add');
        Route::post('store_level', [LevelController::class, 'store'])->name('admin.level.store');
        // Route::post('grade_delete', [LevelController::class, 'delete'])->name('admin.grades.delete');
        Route::post('level_update', [LevelController::class, 'update'])->name('admin.level.update');
        ###########################  for Currency setting
        Route::get('Currency', [CurrencyController::class, 'index'])->middleware(['permission:activate currency'])->name('admin.Currency.get');
        Route::post('Currency_store', [CurrencyController::class, 'edit'])->name('admin.Currency.active');
    });
    ################################### End Settings Routes ###################################################

    ################################### Begin Cours Routes #################################################
    Route::group(['prefix' => 'Cours'], function () {


        Route::get('/', [CoursController::class, 'index'])->name('admin.cours.all');
        Route::get('create', [CoursController::class, 'create'])->name('admin.cours.add');
        Route::post('store', [CoursController::class, 'store'])->name('admin.cours.store');
        // Route::post('grade_delete', [LevelController::class, 'delete'])->name('admin.grades.delete');

    });

    ################################### End Cours Routes ###################################################























    ################################### Begin Language Routes #################################################
    Route::group(['prefix' => 'Users'], function () {

        Route::get('/', [UserController::class, 'index'])->name('admin.users.all');
        Route::get('add', [UserController::class, 'create'])->middleware(['permission:edit'])->name('admin.users.add');
        // Route::post('store',[UserController::class ,'store'])->name('admin.language.store');

        // Route::get('edit/{id}',[UserController::class ,'edit'])->name('admin.language.edit');
        // Route::post('update/{id}',[UserController::class ,'update'])->name('admin.language.update');

        // Route::post('delete',[UserController::class ,'delete'])->name('admin.language.delete');
        Route::post('delete', [LanguageController::class, 'delete'])->name('admin.language.delete');
    });
    ################################### End Language Routes ###################################################
    Route::group(['prefix' => 'supervisor'], function () {

        // Route::get('/', [UserController::class, 'index'])->name('admin.users.all');
        Route::get('add', [SuperviserController::class, 'create'])->name('admin.supervisor.add');
        Route::post('store', [SuperviserController::class, 'store'])->name('admin.supervisor.store');

        // Route::get('edit/{id}',[UserController::class ,'edit'])->name('admin.language.edit');
        // Route::post('update/{id}',[UserController::class ,'update'])->name('admin.language.update');

        // Route::post('delete',[UserController::class ,'delete'])->name('admin.language.delete');
        // Route::post('delete',[LanguageController::class ,'delete'])->name('admin.language.delete');
    });
    ################################### End Language Routes ###################################################







});
