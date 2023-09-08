<?php

use App\Http\Controllers\Admin\MarksController;
use App\Http\Controllers\Admin\StudentsAttendanceController;
use App\Http\Controllers\Admin\RegistartionStudentsController;
Route::group(['prefix' => 'classes', 'middleware' => 'permission:teacher'], function () {
   Route::get('/', [StudentsAttendanceController::class, 'index'])
   ->name('admin.take.attendance.students');
   
   // Route::get('teacher-register-students/{cours_id}', [RegistartionStudentsController::class, 'Teacher_register_new_std'])
   // ->name('admin.teacher.register.new.std');
   
   Route::post('get-students-inforametion', [RegistartionStudentsController::class, 'get_std_by_searche_to_regisater'])
   ->name('admin.search.std.teacher.register.new.std');
   
   Route::post('save-teacher-register-students', [RegistartionStudentsController::class, 'Save_teacher_register_new_std'])
   ->name('admin.save.teacher.register.new.std');


   Route::get('add-general-info/{cours_id}', [MarksController::class, 'add_general_info'])
   ->name('admin.add.marks.cours');
   
   Route::post('store-general-info', [MarksController::class, 'store_general_info'])
   ->name('admin.store.marks.cours');
});

