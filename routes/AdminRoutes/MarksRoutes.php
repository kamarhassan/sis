<?php


use App\Http\Controllers\Admin\MarksController;


Route::group(['prefix' => 'students/Marks' , 
'middleware' => 'permission:reports|change status|reset'], function () {
  
   Route::get('{cours_id}', [MarksController::class, 'admin_report_and_action'])
   ->name('admin.marks.report.and.action')->middleware(['permission:reports']);
   
   Route::post('disable-enable-take-marks', [MarksController::class, 'disable_enable_take_marks'])
   ->name('disable.enable.take.marks')->middleware(['permission:change status|reset']);
   
   Route::post('reset', [MarksController::class, 'reset_marks'])
   ->name('reset.marks')->middleware(['permission:reset']);
   
   // Route::post('export', [MarksController::class, 'export_marks'])
   // ->name('export.marks');

   
});

/**
 * 
 * need to complete reset and export and print
 */
