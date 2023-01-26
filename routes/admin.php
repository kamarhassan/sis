<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\CoursController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\loginController;
use App\Http\Middleware\Admin\PasswordIsChanged;
use App\Http\Controllers\Admin\FeetypeController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\SuperviserController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\SponsorShipController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\RoleAndPermissionController;
use App\Http\Controllers\Admin\Services\ServicesController;
use App\Http\Controllers\Admin\StudentsAttendanceController;
use App\Http\Controllers\Admin\RegistartionStudentsController;
use App\Http\Controllers\Admin\Services\ClientPaymentController;
use App\Http\Controllers\Admin\Services\ServicesReceiptController;


// use App\Http\Livewire\P;

// Route::get('add', [SuperviserController::class, 'create'])->name('admin.supervisor.add');


// define ('PAGINATION_COUNT',10);
Route::group(
    [
        'namespace' => 'Admin',
        'prefix' => LaravelLocalization::setLocale() . '/admin',
        'middleware' => ['guest:admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('login', [loginController::class, 'getlogin'])->name('get.admin.login');
        Route::post('login', [loginController::class, 'login'])->name('admin.login');
        Route::get('logout', [loginController::class, 'logout'])->name('get.admin.logout');
    }
);

######################################### for change password on first logged ################################################
Route::group(
    [
        'namespace' => 'Admin',
        'prefix' => LaravelLocalization::setLocale() . '/admin',
        'middleware' => ['auth:admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::get('change-password', [SuperviserController::class, 'change_password'])->name('admin.change.password.mandatory');
        Route::post('edit-password-first-logged', [SuperviserController::class, 'edit_password_first_logged'])->name('admin.edit.password.first.logged');
        Route::get('inactive-account', [SuperviserController::class, 'acount_inactive'])->name('admin.acount.is.not.active');
    }
);
######################################### for change password on first logged ################################################



Route::group([
    'prefix' => LaravelLocalization::setLocale() . '/admin',
    'middleware' => ['auth:admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'PasswordIsChanged', 'IsActive']

], function () {

    Route::get('logout', [loginController::class, 'logout'])->name('get.admin.logout');;
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashborad');

    Route::get('changemode', [DashboardController::class, 'change_mode'])->name('admin.dashborad.changemode');
    ################################### Begin Language Routes #################################################

    ################################### Begin Settings Routes #################################################

    Route::get('/artisan', [DashboardController::class, 'artisan'])->name('admin.setting.artisan');
    Route::get('/clearcache', [DashboardController::class, 'clearcache']);
    Route::group(['prefix' => 'setting'], function () {
        Route::group(['prefix' => 'supervisor'], function () {
            Route::get('all', [SuperviserController::class, 'all'])->middleware(['permission:edit supervisor|delete supervisor'])->name('admin.supervisor.all');
            Route::get('add', [SuperviserController::class, 'create'])->middleware(['permission:add supervisor'])->name('admin.supervisor.add');
            Route::post('store', [SuperviserController::class, 'store'])->middleware(['permission:add supervisor'])->name('admin.supervisor.store');
            Route::get('edit/{admin_id}', [SuperviserController::class, 'edit'])->middleware(['permission:edit supervisor'])->name('admin.supervisor.edit');
            Route::post('update-info', [SuperviserController::class, 'update_info'])->middleware(['permission:edit supervisor'])->name('admin.supervisor.update.info');
            Route::post('delete-supervisor', [SuperviserController::class, 'delete_supervisor'])->middleware(['permission:delete supervisor'])->name('admin.supervisor.delete.supervisor');
        });

        Route::group(['prefix' => 'sponsor'], function () {
            Route::get('/', [SponsorController::class, 'index'])->middleware(['permission:edit sponsor|delete sponsor|add sponsor'])->name('admin.sponsor.all');
            Route::post('store-sponsor', [SponsorController::class, 'store_sponsor'])->middleware(['permission:add sponsor'])->name('admin.sponsor.store.sponsor');
            Route::post('delete-sponsor', [SponsorController::class, 'delete_sponsor'])->middleware(['permission:delete sponsor'])->name('admin.sponsor.delete.sponsor');
        });

        Route::group(['prefix' => 'certificate'], function () {

            Route::get('/', [CertificateController::class, 'index'])->middleware(['permission:edit certificate |create certificate |delete certificate'])->name('admin.certificate.all');
            Route::get('/new', [CertificateController::class, 'create'])->middleware(['permission:create certificate'])->name('admin.certificate.new');
            Route::post('store-certificate', [CertificateController::class, 'store_certificate'])->middleware(['permission:create certificate'])->name('admin.certificate.store.certificate');
            Route::post('delete-certificate', [CertificateController::class, 'delete_certificate'])->middleware(['permission:delete certificate'])->name('admin.certificate.delete.certificate');
            Route::get('edit/{id}', [CertificateController::class, 'edit_certificate'])->middleware(['permission:edit certificate'])->name('admin.certificate.edit.certificate');
            Route::post('store-edit-certificate', [CertificateController::class, 'save_edit_certificate'])->middleware(['permission:edit certificate'])->name('admin.certificate.save.edit.certificate');
        });
        Route::group(['prefix' => 'cours'], function () {
            Route::get('/', [CategoriesController::class, 'index'])/*->middleware(['permission:edit certificate|delete certificate|add certificate'])*/->name('admin.categories.all');
            Route::get('/new', [CategoriesController::class, 'create'])/*->middleware(['permission:edit certificate|delete certificate|add certificate'])*/->name('admin.categories.new');
            Route::post('store-categories', [CategoriesController::class, 'store_categories'])/*->middleware(['permission:add sponsor'])*/->name('admin.categories.store.categories');
            Route::post('delete-categories', [CategoriesController::class, 'delete_categories'])/*->middleware(['permission:delete sponsor'])*/->name('admin.categories.delete.categories');
            Route::get('edit/{id}', [CategoriesController::class, 'edit_categories'])/*->middleware(['permission:delete sponsor'])*/->name('admin.categories.edit.categories');
            Route::post('post-edit', [CategoriesController::class, 'save_edit_category'])/*->middleware(['permission:delete sponsor'])*/->name('admin.categories.post.edit.categories');
            Route::post('delete-categories-image', [CategoriesController::class, 'delete_image_categories'])/*->middleware(['permission:delete sponsor'])*/->name('admin.categories.delete.image');
            Route::post('delete-categories-image-from-callery', [CategoriesController::class, 'delete_image_categories_from_callery'])/*->middleware(['permission:delete sponsor'])*/->name('admin.categories.delete.image_from_callery');
            // Route::post('store-edit-certificate', [CertificateController::class, 'save_edit_certificate'])/*->middleware(['permission:delete sponsor'])*/->name('admin.certificate.save.edit.certificate');
        });





        ################################### begin Language  Routes ###################################################

        Route::get('/language', [LanguageController::class, 'index'])->middleware(['permission:edit language'])->name('admin.language');
        Route::get('language/edit/{id}', [LanguageController::class, 'edit'])->middleware(['permission:edit language'])->name('admin.language.edit');
        Route::post('language/update/{id}', [LanguageController::class, 'update'])->middleware(['permission:edit language'])->name('admin.language.update');
        ################################### End Language  Routes ###################################################

        ################################### begin roles and permmission  Routes ###################################################
        Route::get('role', [RoleAndPermissionController::class, 'all_role'])->middleware(['permission:create roles|edit roles|delete roles'])->name('admin.setting.role');
        Route::post('delete-role', [RoleAndPermissionController::class, 'delete_role'])->middleware(['permission:delete roles'])->name('admin.setting.delete.role');
        Route::post('new-role', [RoleAndPermissionController::class, 'new_role'])->middleware(['permission:create roles'])->name('admin.setting.new.role');
        Route::post('get_permission_for_role/{role_id}', [RoleAndPermissionController::class, 'get_permission_for_role'])->middleware(['permission:edit roles'])->name('admin.setting.get.permission.for.role');
        Route::post('update_permission_for_role', [RoleAndPermissionController::class, 'update_permission_for_role'])->middleware(['permission:edit roles'])->name('admin.setting.update.permission.for.role');
        ################################### End of  roles and permmission  Routes ###################################################

        ###########################  for grades setting
        Route::get('add_grades', [GradeController::class, 'create'])->middleware(['permission:create grades'])->name('admin.grades.add');
        Route::post('grade_store', [GradeController::class, 'store'])->middleware(['permission:create grades'])->name('admin.grades.store');
        Route::post('grade_delete', [GradeController::class, 'delete'])->middleware(['permission:delete grades'])->name('admin.grades.delete');
        Route::post('grade_update', [GradeController::class, 'update'])->middleware(['permission:edit grades'])->name('admin.grades.update');

        ###########################  for level setting
        Route::get('add_levels', [LevelController::class, 'create'])->middleware(['permission:create levels|edit levels|delete levels'])->name('admin.level.add');
        Route::post('store_level', [LevelController::class, 'store'])->middleware(['permission:create levels'])->name('admin.level.store');

        Route::post('level_update', [LevelController::class, 'update'])->middleware(['permission:edit levels'])->name('admin.level.update');
        Route::post('delet', [LevelController::class, 'delete'])->middleware(['permission:delete levels'])->name('admin.level.delet');

        ###########################  for Currency setting
        Route::get('currency', [CurrencyController::class, 'index'])->middleware(['permission:activate_currency'])->middleware(['permission:activate_currency'])->name('admin.Currency.get');
        Route::post('currency_activate', [CurrencyController::class, 'activate'])->middleware(['permission:activate_currency'])->name('admin.Currency.active.disactive');

        ###########################  for services setting
        // 'create setting services', 'edit setting services', 'delete setting services'
        Route::get('services', [ServicesController::class, 'create'])->middleware(['permission:create setting services|edit setting services|delete setting services'])->name('admin.Services.add');
        Route::post('store', [ServicesController::class, 'store'])->middleware(['permission:create setting services'])->name('admin.Services.store');
        Route::post('services_delete', [ServicesController::class, 'delete'])->middleware(['permission:delete setting services'])->name('admin.services.delete');
        Route::post('get-services-update/{services_id}', [ServicesController::class, 'to_update'])->middleware(['permission:edit setting services'])->name('admin.services.to-update');
        Route::post('update', [ServicesController::class, 'update'])->middleware(['permission:edit setting services'])->name('admin.services.update');
        ###########################  for fee type setting
        Route::get('fee_type', [FeetypeController::class, 'index'])->middleware(['permission:edit fee type|create fee type|delete fee type'])->name('admin.setting.fee');
        Route::post('store_fee_type', [FeetypeController::class, 'store'])->middleware(['permission:create fee type'])->name('admin.setting.fee.store');
        Route::post('delete_fee_type', [FeetypeController::class, 'delete'])->middleware(['permission:delete fee type'])->name('admin.setting.fee.delete');
    });
    ################################### End Settings Routes ###################################################

    ################################### Begin Cours Routes #################################################
    Route::group(['prefix' => 'cours'], function () {
        Route::get('/', [CoursController::class, 'index'])->middleware(['permission:create cours|edit cours|delete cours'])->name('admin.cours.all');
        Route::get('create', [CoursController::class, 'create'])->middleware(['permission:create cours'])->name('admin.cours.add');
        Route::post('store', [CoursController::class, 'store'])->middleware(['permission:create cours'])->name('admin.cours.store');
        Route::get('edit/{id}', [CoursController::class, 'edit'])->middleware(['permission:edit cours'])->name('admin.cours.edit');
        Route::post('update/{id}', [CoursController::class, 'update'])->middleware(['permission:edit cours'])->name('admin.cours.update');
        Route::post('delete', [CoursController::class, 'delete'])->middleware(['permission:delete cours'])->name('admin.cours.delete');
    });

    ################################### End Cours Routes ###################################################


    ################################### Begin Students Routes #################################################


    Route::group(['prefix' => 'students'], function () {
        Route::get('/', [StudentsController::class, 'students'])->middleware(['permission:show all students'])->name('admin.students.all');
        Route::get('add-students', [StudentsController::class, 'add_students'])->middleware(['permission:add students'])->name('admin.students.add');
        Route::Post('export-file-to-import', [StudentsController::class, 'export_file_to_import'])->middleware(['permission:add students'])->name('admin.export.file.to.import.students');
        Route::Post('export-file-have-error', [StudentsController::class, 'export_file_have_error'])->middleware(['permission:add students'])->name('admin.export.file.have.error.students');
        Route::post('import-std-excel', [StudentsController::class, 'import_std_excel'])->middleware(['permission:add students'])->name('admin.import.file.students');
        Route::post('save-by-form', [StudentsController::class, 'save_by_form'])->middleware(['permission:add students'])->name('admin.add.students.form');

        Route::view('Registration', 'admin.livewire.students.std_registration')->middleware(['permission:register students'])->name('admin.students.Registration-1');
        Route::get('payment', [StudentsController::class, 'get_std_to_payment'])->middleware(['permission:payment students'])->name('admin.students.get_std_to_payment');
        Route::post('get_cours_std/{id}', [StudentsController::class, 'get_cours_std'])->middleware(['permission:payment students'])->name('admin.students.get_cours_std');
        Route::get('receipt', [ReceiptController::class, 'All_receipt'])->middleware(['permission:edit old payment students|delete old payment students|print old payment students'])->name('admin.all-receipt');
        Route::get('edit-old-payment/{receipt_id}', [PaymentController::class, 'edit_payment'])->middleware(['permission:edit old payment students'])->name('admin.students.payment.edit');
        Route::post('delet_receipt', [PaymentController::class, 'delete_payment_receipt'])->middleware(['permission:delete old payment students'])->name('admin.students.delete_payment_receipt');

        Route::get('new-registration-order', [AdminNotificationController::class, 'new_register'])->middleware('permission:register order delete all|register order deny all|register order aprrove|register order deny|see notification|read only register order|register order read all|register order aprrove all')->name('admin.new.register.order');
        Route::post('approve-user-register', [RegistartionStudentsController::class, 'approve_user_register'])->middleware(['permission:register order aprrove'])->name('admin.notification.approve.user');
        Route::post('approve-new-register', [RegistartionStudentsController::class, 'approve_edit_register'])->middleware(['permission:register order aprrove'])->name('admin.notification.approve.edit.register');
        Route::post('approved', [RegistartionStudentsController::class, 'approved_new_register'])->middleware(['permission:register order aprrove'])->name('admin.notification.approve.new.register');
    });

    Route::group(['prefix' => 'students/attendance', 'middleware' => 'permission:attendance students|report attendance|reset|enable or disable'], function () {
        Route::get('/', [StudentsAttendanceController::class, 'index'])->middleware(['permission:attendance students'])->name('admin.take.attendance.students');
        Route::get('{cours_id}', [StudentsAttendanceController::class, 'attendance_general_info'])->middleware(['permission:attendance students'])->name('admin.attendance.general.info');
        Route::post('students_of_cours', [StudentsAttendanceController::class, 'take_students_for_cours'])->middleware(['permission:attendance students'])->name('admin.take.students.for.cours');
        Route::post('create-or-update-attendance', [StudentsAttendanceController::class, 'create_or_update_attendance'])->middleware(['permission:attendance students'])->name('admin.create.or.update.attendance');
        Route::get('report-attendance/{cours_id}', [StudentsAttendanceController::class, 'report_attendance'])->middleware(['permission:report attendance'])->name('admin.report.attendance');
        Route::get('status/{cours_id}', [StudentsAttendanceController::class, 'enable_disable_reset_take_attendance'])->middleware(['permission:reset|enable or disable'])->name('admin.enable.disable.take.attendance');
        Route::post('reset-old-attendance/{cours_id}/{attendance_date}', [StudentsAttendanceController::class, 'reset_old_attendance'])->middleware(['permission:reset'])->name('admin.reset.old.attendance');
        Route::post('edit-status/{cours_id}/{attendance_date}', [StudentsAttendanceController::class, 'edit_status_attendance'])->middleware(['permission:enable or disable'])->name('admin.edit.status.attendance');
        Route::post('enable-all/{cours_id}', [StudentsAttendanceController::class, 'enable_all'])->middleware(['permission:enable or disable'])->name('admin.enable.all.status.attendance');
        Route::post('disable-all/{cours_id}', [StudentsAttendanceController::class, 'disable_all'])->middleware(['permission:enable or disable'])->name('admin.disable.all.status.attendance');
        Route::post('reset-all/{cours_id}', [StudentsAttendanceController::class, 'reset_all'])->middleware(['permission:reset'])->name('admin.reset.all.status.attendance');
    });
    Route::group(['prefix' => 'students/sponsored', 'middleware' => 'permission:edit students sponsore'], function () {
        Route::get('/', [SponsorShipController::class, 'index'])/*->*/->name('admin.cours.sponsore.index');
        Route::post('get-sponsor-ship', [SponsorShipController::class, 'get_sponsor_ships_to_get_students'])/*->*/->name('admin.cours.sponsore.ships');
        Route::post('get-students-for-sponsor', [SponsorShipController::class, 'get_students_for_sponsor'])/*->*/->name('admin.cours.sponsore.student');
        Route::post('create-sponsor-for-students', [SponsorShipController::class, 'create_sponsor_fee_for_students'])/*->*/->name('admin.create.sponsor.fee.for.students');
        Route::post('create-same-sponsor-for-students', [SponsorShipController::class, 'create_same_sponsore_fee_for_students'])/*->*/->name('admin.create.same.sponsor.fee.for.students');

        Route::get('edit-sponsor-for-students', [SponsorShipController::class, 'edit_sponsor_fee_for_students'])/*->*/->name('admin.edit.sponsor.fee.for.students');
        // Route::get('get_test', [SponsoprShipController::class,'get_test'])/*->*/->name('admin1.cours.sponsore.ships');

    });
    ################################### Begin Language Routes #################################################

    ################################### Begin Payment Routes #################################################
    Route::group(['prefix' => 'payment'], function () {

        Route::get('/', [PaymentController::class, 'index'])->name('admin.payment.index');
        Route::get('{cours_id}/{user_id}', [PaymentController::class, 'user_paid_for_cours'])->name('admin.payment.user_paid_for_cours');
        Route::post('payment_receipt', [PaymentController::class, 'savepayment'])->name('admin.payment.payment_to_receipt');
        Route::post('edit_payment_receipt', [PaymentController::class, 'save_edit_payment'])->name('admin.payment_edit_to_receipt');
        Route::get('receipt/{user_id}/{cours_id}/{receipt_id}', [ReceiptController::class, 'receipt'])->name('admin.payment.receipt');
        Route::get('client/receipt/{user_service_receipt_id}', [ServicesReceiptController::class, 'receipt'])->name('admin.payment.service.receipt');
    });

    ################################### end  Payment Routes #################################################



    ################################### Begin Services  Routes #################################################

    Route::group(['prefix' => 'services'], function () {

        Route::view('client', 'admin.livewire.services.services-to-client')->middleware(['permission:register service to client'])->name('admin.Services.to.client');
        Route::get('receipt', [ServicesReceiptController::class, 'All_receipt'])->middleware('permission:edit old services receipt|delete old services receipt|print old services receipt')->name('admin.Services.all-receipt');

        Route::get('payment', [ClientPaymentController::class, 'get_remaining_for_services'])->middleware(['permission:payment remaining'])->name('admin.get.remaining.for.services');
        Route::get('services/{user_service_id}', [ClientPaymentController::class, 'user_paid_for_services'])->middleware(['permission:register service to client'])->name('admin.payment.user_paid_for_services');
        Route::get('paid-services/{user_service_id}', [ClientPaymentController::class, 'user_paid_for_services_for_remaining'])/*->middleware(['permission:payment for client services'])*/->name('admin.payment.user_paid_for_services_for_remaining');

        Route::post('save_payment_client-for-remaining', [ClientPaymentController::class, 'savepaymentCientRemainig'])/*->middleware(['permission:payment for client services'])*/->name('admin.payment.payment_client_remaining_to_receipt');
        Route::post('save_payment_client', [ClientPaymentController::class, 'savepaymentCient'])->middleware(['permission:register service to client'])->name('admin.payment.payment_client_to_receipt');
        Route::get('edit-old-payment/{receipt_id}', [ClientPaymentController::class, 'get_old_payment'])->middleware(['permission:edit old services receipt|delete old services receipt|print old services receipt'])->name('admin.service.get_old_payment.edit');
        Route::post('delet_receipt', [ServicesReceiptController::class, 'delete_payment_receipt'])->middleware(['permission:delete old services receipt'])->name('admin.service.delete_payment_receipt');
        Route::post('edit-payment', [ClientPaymentController::class, 'edit_payment'])->middleware(['permission:edit old services receipt'])->name('admin.service.edit.old.payment');
    });
    ################################### end  Services Routes #################################################
    Route::group(['prefix' => 'reports'], function () {
        Route::get('/', [ReportsController::class, 'index'])->middleware(['permission:reports'])->name('admin.report');
        Route::post('daily-report', [ReportsController::class, 'daily_report'])->middleware(['permission:reports'])->name('admin.daily.report');
        Route::post('distrubtion', [ReportsController::class, 'dist_'])->middleware(['permission:reports'])->name('admin.distrubtion.report');
        Route::post('service-by-type', [ReportsController::class, 'service_by_type'])->middleware(['permission:reports'])->name('admin.service.by.type.report');
        Route::post('unpaid-account-summary', [ReportsController::class, 'unpaid_account_summary'])->middleware(['permission:reports'])->name('admin.unpaid.account.summary.report');
        Route::post('unpaid-account-details', [ReportsController::class, 'unpaid_account_details'])->middleware(['permission:reports'])->name('admin.unpaid.account.details.report');
        Route::post('cours-account-summary', [ReportsController::class, 'cours_account_summary'])->middleware(['permission:reports'])->name('admin.cours.account.summary.report');
        Route::post('cours-account-details', [ReportsController::class, 'cours_account_details'])->middleware(['permission:reports'])->name('admin.cours.account.details.report');
    });
    ################################### end  Services Routes #################################################

    ################################### begin Language  Routes ###################################################
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('admin.profile');
        Route::post('update-info', [ProfileController::class, 'update_info'])->name('admin.profile.update.info');
        // Route::post('language/update/{id}', [ProfileController::class, 'update'])->middleware(['permission:edit language'])->name('admin.language.update');
    });
    ################################### End Language  Routes ###################################################


    Route::group(['prefix' => 'users'], function () {

        Route::get('/', [UserController::class, 'index'])->middleware(['permission:activate_currency'])->name('admin.users.all');
        Route::get('add', [UserController::class, 'create'])->middleware(['permission:edit'])->middleware(['permission:activate_currency'])->name('admin.users.add');
        Route::post('delete', [LanguageController::class, 'delete'])->middleware(['permission:activate_currency'])->name('admin.language.delete');
    });
    ################################### End Language Routes ###################################################

    ################################### End Language Routes ###################################################


    Route::group(['prefix' => 'notification'], function () {
        Route::get('all', [AdminNotificationController::class, 'all'])/*->middleware(['permission:register order delete all|register order deny all|register order aprrove|register order deny|see notification|read only register order|register order read all|register order aprrove all'])*/->name('admin.notification.all');
        Route::get('new-register', [AdminNotificationController::class, 'new_register'])/*->middleware('permission:register order delete all|register order deny all|register order aprrove|register order deny|see notification|read only register order|register order read all|register order aprrove all')*/->name('admin.notification.new.register');
        Route::post('get_user_info/{orders_id}', [AdminNotificationController::class, 'user_info_with_cours'])/*->middleware('permission:read only register order')*/->name('admin.notification.get.user.info');
        Route::post('delete-marked', [AdminNotificationController::class, 'delete_marked'])->name('admin.notification.delete.marked');
        Route::post('deny-marked', [AdminNotificationController::class, 'deny_marked'])->name('admin.notification.deny.marked');
        Route::post('read-marked', [AdminNotificationController::class, 'read_marked'])->name('admin.notification.read.marked');
        Route::post('approve-marked', [AdminNotificationController::class, 'approve_marked'])->name('admin.notification.approve.marked');
    });
    ################################### End notification Routes ###################################################


});
