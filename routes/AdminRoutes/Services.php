<?php

use App\Http\Controllers\Admin\Services\ClientPaymentController;
use App\Http\Controllers\Admin\Services\ServicesReceiptController;
Route::group(['prefix' => 'services'], function () {


   Route::view('client', 'admin.livewire.services.services-to-client')
->middleware(['permission:register service to client'])->name('admin.Services.to.client');

Route::get('receipt', [ServicesReceiptController::class, 'All_receipt'])
->middleware('permission:edit old services receipt|delete old services receipt|print old services receipt')->name('admin.Services.all-receipt');


Route::get('payment', [ClientPaymentController::class, 'get_remaining_for_services'])
->middleware(['permission:payment remaining'])->name('admin.get.remaining.for.services');

Route::get('services/{user_service_id}', [ClientPaymentController::class, 'user_paid_for_services'])
->middleware(['permission:register service to client'])->name('admin.payment.user_paid_for_services');

Route::get('paid-services/{user_service_id}', [ClientPaymentController::class, 'user_paid_for_services_for_remaining'])/*
->middleware(['permission:payment for client services'])*/->name('admin.payment.user_paid_for_services_for_remaining');


Route::post('save_payment_client-for-remaining', [ClientPaymentController::class, 'savepaymentCientRemainig'])/*
->middleware(['permission:payment for client services'])*/->name('admin.payment.payment_client_remaining_to_receipt');

Route::post('save_payment_client', [ClientPaymentController::class, 'savepaymentCient'])
->middleware(['permission:register service to client'])->name('admin.payment.payment_client_to_receipt');

Route::get('edit-old-payment/{receipt_id}', [ClientPaymentController::class, 'get_old_payment'])
->middleware(['permission:edit old services receipt|delete old services receipt|print old services receipt'])->name('admin.service.get_old_payment.edit');

Route::post('delet_receipt', [ServicesReceiptController::class, 'delete_payment_receipt'])
->middleware(['permission:delete old services receipt'])->name('admin.service.delete_payment_receipt');

Route::post('edit-payment', [ClientPaymentController::class, 'edit_payment'])
->middleware(['permission:edit old services receipt'])->name('admin.service.edit.old.payment');
});