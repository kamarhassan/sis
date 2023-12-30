<?php


use App\Http\Controllers\Admin\CoursController;

Route::group(['prefix' => 'cours'], function () {
   Route::get('/', [CoursController::class, 'index'])
      ->middleware(['permission:create cours|edit cours|delete cours'])->name('admin.cours.all');

   Route::get('create', [CoursController::class, 'create'])
      ->middleware(['permission:create cours'])->name('admin.cours.add');

   Route::post('store', [CoursController::class, 'store'])
      ->middleware(['permission:create cours'])->name('admin.cours.store');

   Route::get('edit/{id}', [CoursController::class, 'edit'])
      ->middleware(['permission:edit cours'])->name('admin.cours.edit');

   Route::post('update/{id}', [CoursController::class, 'update'])
      ->middleware(['permission:edit cours'])->name('admin.cours.update');

   Route::post('delete', [CoursController::class, 'delete'])
      ->middleware(['permission:delete cours'])->name('admin.cours.delete');



   Route::get('info/{id}', [CoursController::class, 'info'])
      ->middleware(['permission:info cours'])->name('admin.cours.info');
   


});
