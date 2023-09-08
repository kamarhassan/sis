<?php

use App\Http\Controllers\Admin\ProfileController;
 Route::group(['prefix' => 'profile'], function () {
      Route::get('/', [ProfileController::class, 'index'])
      ->name('admin.profile');
      
      Route::post('update-info', [ProfileController::class, 'update_info'])
      ->name('admin.profile.update.info');
      
      // Route::post('language/update/{id}', [ProfileController::class, 'update'])->middleware(['permission:edit language'])
      // ->name('admin.language.update');
   });
