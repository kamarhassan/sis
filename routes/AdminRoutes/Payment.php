<?php

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\Services\ServicesReceiptController;


Route::group(['prefix' => 'payment'], function () {

   Route::get('/', [PaymentController::class, 'index'])
      ->name('admin.payment.index');

   Route::get('{cours_id}/{user_id}', [PaymentController::class, 'user_paid_for_cours'])
      ->name('admin.payment.user_paid_for_cours');

   Route::post('payment_receipt', [PaymentController::class, 'savepayment'])
      ->name('admin.payment.payment_to_receipt');

   Route::post('edit_payment_receipt', [PaymentController::class, 'save_edit_payment'])
      ->name('admin.payment_edit_to_receipt');

   Route::get('receipt/{user_id}/{cours_id}/{receipt_id}', [ReceiptController::class, 'receipt'])
      ->name('admin.payment.receipt');

   Route::get('client/receipt/{user_service_receipt_id}', [ServicesReceiptController::class, 'receipt'])
      ->name('admin.payment.service.receipt');
});
