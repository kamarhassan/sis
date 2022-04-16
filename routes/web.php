<?php

use App\Http\Livewire\Count;
use App\Http\Livewire\Counter;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// Route::get('/p', Count::class);
Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/w', 'Livewire\Counter')->name('home');
// C:\xampp\htdocs\sis\app\Http\Livewire\Counter.php
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
