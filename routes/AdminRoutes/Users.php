<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\LanguageController;

Route::group(['prefix' => 'users'], function () {

   Route::get('/', [UserController::class, 'index'])
      ->middleware(['permission:activate_currency'])->name('admin.users.all');

   Route::get('add', [UserController::class, 'create'])
      ->middleware(['permission:edit'])
      ->middleware(['permission:activate_currency'])->name('admin.users.add');

   Route::post('delete', [LanguageController::class, 'delete'])
      ->middleware(['permission:activate_currency'])->name('admin.language.delete');
});
