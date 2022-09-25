<?php

use App\Http\Controllers\FrontEnd\CoursDetailController;
use App\Http\Livewire\Count;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\FrontEnd\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('web.index');

Auth::routes(['verify' => true]);
// Auth::routes();

Route::group(
    [

        'middleware' => ['verified']
    ],
    function () {
        Route::get('dashboard', [UserDashboradController::class, 'index'])->name('web.dashboard');
        Route::get('my-cours/{user_id}', [UserDashboradController::class, 'user_cours_reserved'])->name('web.user.cours');
        Route::get('cours/{cours_name}/{coursid}', [CoursDetailController::class, 'cours_details'])->name('web.cours-details');
        Route::post('delete', [RegisterCoursController::class, 'delete_cours_reserved'])->name('web.delete.cours.reserved');
        Route::post('register-cours', [RegisterCoursController::class, 'RegisterCours'])->name('web.registerCours');
    }
);
