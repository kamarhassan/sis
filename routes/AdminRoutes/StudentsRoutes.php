<?php


use App\Http\Controllers\Admin\MarksController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\Admin\SponsorShipController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\StudentsAttendanceController;
use App\Http\Controllers\Admin\StudentsCertificateController;
use App\Http\Controllers\Admin\RegistartionStudentsController;

Route::group(['prefix' => 'students'], function () {
   Route::get('/', [StudentsController::class, 'students'])
   ->middleware(['permission:show all students'])->name('admin.students.all');
   
   Route::get('/profile/{id}', [StudentsController::class, 'students_profile'])
   ->middleware(['permission:show all students'])->name('admin.students.profile');
   
   Route::get('add-students', [StudentsController::class, 'add_students'])
   ->middleware(['permission:add students'])->name('admin.students.add');
    
      Route::get('edit-student-information/{id}', [StudentsController::class, 'edit_student_information'])
   ->middleware(['permission:add students'])->name('admin.students.edit.information');
      
       Route::post('post-edit-student-information', [StudentsController::class, 'save_edit_student_information'])
   ->middleware(['permission:add students'])->name('admin.students.post-edit.information');
      
       Route::post('post-edit-student-password-information', [StudentsController::class, 'save_edit_password_student_information'])
   ->middleware(['permission:add students'])->name('admin.students.post-edit.password.information');
   
   
   
   
   
   Route::Post('export-file-to-import', [StudentsController::class, 'export_file_to_import'])
   ->middleware(['permission:add students'])->name('admin.export.file.to.import.students');
   
   Route::Post('export-file-have-error', [StudentsController::class, 'export_file_have_error'])
   ->middleware(['permission:add students'])->name('admin.export.file.have.error.students');
   
   Route::post('import-std-excel', [StudentsController::class, 'import_std_excel'])
   ->middleware(['permission:add students'])->name('admin.import.file.students');
   
   Route::post('save-by-form', [StudentsController::class, 'save_by_form'])
   ->middleware(['permission:add students'])->name('admin.add.students.form');


   Route::view('Registration', 'admin.livewire.students.std_registration')
   ->middleware(['permission:register students'])->name('admin.students.Registration-1');
   
   Route::get('new-registration/{cours_id}/{user_id}/{_token?}', [RegistartionStudentsController::class, 'new_register'])
   ->middleware(['permission:register students'])->name('admin.students.Registration-2');



   Route::get('payment', [StudentsController::class, 'get_std_to_payment'])
   ->middleware(['permission:payment students'])->name('admin.students.get_std_to_payment');
   
   Route::post('get_cours_std/{id}', [StudentsController::class, 'get_cours_std'])
   ->middleware(['permission:payment students'])->name('admin.students.get_cours_std');
   
   Route::get('receipt', [ReceiptController::class, 'All_receipt'])
   ->middleware(['permission:edit old payment students|delete old payment students|print old payment students'])->name('admin.all-receipt');
   
   Route::get('edit-old-payment/{receipt_id}', [PaymentController::class, 'edit_payment'])
   ->middleware(['permission:edit old payment students'])->name('admin.students.payment.edit');
   
   Route::post('delet_receipt', [PaymentController::class, 'delete_payment_receipt'])
   ->middleware(['permission:delete old payment students'])->name('admin.students.delete_payment_receipt');


   Route::get('new-registration-order', [AdminNotificationController::class, 'new_register'])
   ->middleware('permission:register order delete all|register order deny all|register order aprrove|register order deny|see notification|read only register order|register order read all|register order aprrove all')->name('admin.new.register.order');
   
   Route::post('approve-user-register', [RegistartionStudentsController::class, 'approve_user_register'])
   ->middleware(['permission:register order aprrove'])->name('admin.notification.approve.user');
   
   Route::post('approve-new-register', [RegistartionStudentsController::class, 'approve_edit_register'])
   ->middleware(['permission:register order aprrove'])->name('admin.notification.approve.edit.register');
   
   Route::post('approved', [RegistartionStudentsController::class, 'approved_new_register'])
   ->middleware(['permission:register order aprrove'])->name('admin.approve.new.register');



   Route::get('marks/{cours_id}', [MarksController::class, 'get_std_to_add__or_update_marks'])->name('admin.get.students.to.add.marks');
   Route::post('post-or-update-marks-std', [MarksController::class, 'post_or_update_marks_std'])->name('admin.post.students.and.marks');
   Route::get('report-marks/{cours_id}', [MarksController::class, 'admin_report_and_action'])->name('admin.get.report.students.to.add.marks');


   Route::get('edit-registration/{user_id}/{cours_id}', [RegistartionStudentsController::class, 'edit_registration'])
      /*->middleware(['permission:cours info'])*/->name('admin.edit-registration');
   
   Route::post('delete-std-registration', [RegistartionStudentsController::class, 'delete_std_registration'])
      /*->middleware(['permission:cours info'])*/->name('admin.delete-std-registration');
   Route::post('post-std-edit-registration', [RegistartionStudentsController::class, 'post_edit_registration'])
      /*->middleware(['permission:cours info'])*/->name('admin.post-std-edit-registration');

});

Route::group(['prefix' => 'students/attendance', 'middleware' => 'permission:attendance students|report attendance|reset|enable or disable'], function () {

   Route::get('{cours_id}', [StudentsAttendanceController::class, 'attendance_general_info'])
   ->middleware(['permission:attendance students'])->name('admin.attendance.general.info');
   
   Route::post('students_of_cours', [StudentsAttendanceController::class, 'take_students_for_cours'])
   ->middleware(['permission:attendance students'])->name('admin.take.students.for.cours');
   
   Route::post('create-or-update-attendance', [StudentsAttendanceController::class, 'create_or_update_attendance'])
   ->middleware(['permission:attendance students'])->name('admin.create.or.update.attendance');
   
   Route::get('report-attendance/{cours_id}', [StudentsAttendanceController::class, 'report_attendance'])
   ->middleware(['permission:report attendance'])->name('admin.report.attendance');
   
   Route::get('status/{cours_id}', [StudentsAttendanceController::class, 'enable_disable_reset_take_attendance'])
   ->middleware(['permission:reset|enable or disable'])->name('admin.enable.disable.take.attendance');
   
   Route::post('reset-old-attendance/{cours_id}/{attendance_date}', [StudentsAttendanceController::class, 'reset_old_attendance'])
   ->middleware(['permission:reset'])->name('admin.reset.old.attendance');
   
   Route::post('edit-status/{cours_id}/{attendance_date}', [StudentsAttendanceController::class, 'edit_status_attendance'])
   ->middleware(['permission:enable or disable'])->name('admin.edit.status.attendance');
   
   Route::post('enable-all/{cours_id}', [StudentsAttendanceController::class, 'enable_all'])
   ->middleware(['permission:enable or disable'])->name('admin.enable.all.status.attendance');
   
   Route::post('disable-all/{cours_id}', [StudentsAttendanceController::class, 'disable_all'])
   ->middleware(['permission:enable or disable'])->name('admin.disable.all.status.attendance');
   
   Route::post('reset-all/{cours_id}', [StudentsAttendanceController::class, 'reset_all'])
   ->middleware(['permission:reset'])->name('admin.reset.all.status.attendance');





});


Route::group(['prefix' => 'students/attendance', 'middleware' => 'permission:attendance students|report attendance|reset|enable or disable'], function () {

   Route::get('{cours_id}', [StudentsAttendanceController::class, 'attendance_general_info'])
   ->middleware(['permission:attendance students'])->name('admin.attendance.general.info');
   
   Route::post('students_of_cours', [StudentsAttendanceController::class, 'take_students_for_cours'])
   ->middleware(['permission:attendance students'])->name('admin.take.students.for.cours');
   
   Route::post('create-or-update-attendance', [StudentsAttendanceController::class, 'create_or_update_attendance'])
   ->middleware(['permission:attendance students'])->name('admin.create.or.update.attendance');
   
   Route::get('report-attendance/{cours_id}', [StudentsAttendanceController::class, 'report_attendance'])
   ->middleware(['permission:report attendance'])->name('admin.report.attendance');
   
   Route::get('status/{cours_id}', [StudentsAttendanceController::class, 'enable_disable_reset_take_attendance'])
   ->middleware(['permission:reset|enable or disable'])->name('admin.enable.disable.take.attendance');
   
   Route::post('reset-old-attendance/{cours_id}/{attendance_date}', [StudentsAttendanceController::class, 'reset_old_attendance'])
   ->middleware(['permission:reset'])->name('admin.reset.old.attendance');
   
   Route::post('edit-status/{cours_id}/{attendance_date}', [StudentsAttendanceController::class, 'edit_status_attendance'])
   ->middleware(['permission:enable or disable'])->name('admin.edit.status.attendance');
   
   Route::post('enable-all/{cours_id}', [StudentsAttendanceController::class, 'enable_all'])
   ->middleware(['permission:enable or disable'])->name('admin.enable.all.status.attendance');
   
   Route::post('disable-all/{cours_id}', [StudentsAttendanceController::class, 'disable_all'])
   ->middleware(['permission:enable or disable'])->name('admin.disable.all.status.attendance');
   
   Route::post('reset-all/{cours_id}', [StudentsAttendanceController::class, 'reset_all'])
   ->middleware(['permission:reset'])->name('admin.reset.all.status.attendance');








});

Route::group(['prefix' => 'students/sponsored', 'middleware' => 'permission:edit students sponsore'], function () {
   Route::get('/', [SponsorShipController::class, 'index'])/*->*/->name('admin.cours.sponsore.index');
   Route::post('get-sponsor-ship', [SponsorShipController::class, 'get_sponsor_ships_to_get_students'])/*->*/->name('admin.cours.sponsore.ships');
   Route::post('get-students-for-sponsor', [SponsorShipController::class, 'get_students_for_sponsor'])/*->*/->name('admin.cours.sponsore.student');
   Route::post('create-sponsor-for-students', [SponsorShipController::class, 'create_sponsor_fee_for_students'])/*->*/->name('admin.create.sponsor.fee.for.students');
   Route::post('create-same-sponsor-for-students', [SponsorShipController::class, 'create_same_sponsore_fee_for_students'])/*->*/->name('admin.create.same.sponsor.fee.for.students');

   Route::get('edit-sponsor-for-students', [SponsorShipController::class, 'edit_sponsor_fee_for_students'])/*->*/->name('admin.edit.sponsor.fee.for.students');

});







Route::group(['prefix' => 'generate-certificate', 'middleware' => 'permission:generate certificate'], function () {
   Route::get('/{cours_id}', [StudentsCertificateController::class, 'index'])
   /*->*/->name('admin.generate.certificate.with.barcode');
   Route::post('post-admin-generate-certificate', [StudentsCertificateController::class, 'post_generate_certificate'])
   /*->*/->name('admin.post.admin.generate.certificate');
  
});







