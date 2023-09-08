<?php

use App\Http\Controllers\Admin\ReportsController;
 Route::group(['prefix' => 'reports'], function () {
   Route::get('/', [ReportsController::class, 'index'])
   ->middleware(['permission:reports'])->name('admin.report');
   
   Route::post('daily-report', [ReportsController::class, 'daily_report'])
   ->middleware(['permission:reports'])->name('admin.daily.report');
   
   Route::post('distrubtion', [ReportsController::class, 'dist_'])
   ->middleware(['permission:reports'])->name('admin.distrubtion.report');
   
   Route::post('service-by-type', [ReportsController::class, 'service_by_type'])
   ->middleware(['permission:reports'])->name('admin.service.by.type.report');
   
   Route::post('unpaid-account-summary', [ReportsController::class, 'unpaid_account_summary'])
   ->middleware(['permission:reports'])->name('admin.unpaid.account.summary.report');
   
   Route::post('unpaid-account-details', [ReportsController::class, 'unpaid_account_details'])
   ->middleware(['permission:reports'])->name('admin.unpaid.account.details.report');
   
   Route::post('cours-account-summary', [ReportsController::class, 'cours_account_summary'])
   ->middleware(['permission:reports'])->name('admin.cours.account.summary.report');
   
   Route::post('cours-account-details', [ReportsController::class, 'cours_account_details'])
   ->middleware(['permission:reports'])->name('admin.cours.account.details.report');
});
