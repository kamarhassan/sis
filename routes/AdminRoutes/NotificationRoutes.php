<?php

use App\Http\Controllers\Admin\AdminNotificationController;

Route::group(['prefix' => 'notification'], function () {
   Route::get('all', [AdminNotificationController::class, 'all'])/*->middleware(['permission:register order delete all|register order deny all|register order aprrove|register order deny|see notification|read only register order|register order read all|register order aprrove all'])*/
      ->name('admin.notification.all');

   Route::get('new-register', [AdminNotificationController::class, 'new_register'])/*->middleware('permission:register order delete all|register order deny all|register order aprrove|register order deny|see notification|read only register order|register order read all|register order aprrove all')*/
      ->name('admin.notification.new.register');

   Route::post('get_user_info/{orders_id}', [AdminNotificationController::class, 'user_info_with_cours'])/*->middleware('permission:read only register order')*/
      ->name('admin.notification.get.user.info');

   Route::post('delete-marked', [AdminNotificationController::class, 'delete_marked'])
      ->name('admin.notification.delete.marked');

   Route::post('deny-marked', [AdminNotificationController::class, 'deny_marked'])
      ->name('admin.notification.deny.marked');

   Route::post('read-marked', [AdminNotificationController::class, 'read_marked'])
      ->name('admin.notification.read.marked');

   Route::post('approve-marked', [AdminNotificationController::class, 'approve_marked'])
      ->name('admin.notification.approve.marked');


   Route::get('/', [AdminNotificationController::class, 'index'])
      // ->middleware('permission:')
      ->name('admin.all.notification');
   Route::post('low-stock-details/{order_id}', [AdminNotificationController::class, 'low_stock_details'])
      // ->middleware('permission:')
      ->name('admin.low.stock.notification');
});
