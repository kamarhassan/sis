<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\CoursController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\loginController;
use App\Http\Middleware\Admin\PasswordIsChanged;
use App\Http\Controllers\Admin\FeetypeController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SuperviserController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\RoleAndPermissionController;
use App\Http\Controllers\Admin\Services\ServicesController;
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
    'middleware' => ['auth:admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'PasswordIsChanged','IsActive']

], function () {

    Route::get('logout', [loginController::class, 'logout'])->name('get.admin.logout');
    // Route::get('change-password', [SuperviserController::class,'change_password'])->name('admin.change.password.mandatory');

    // Route::resource('products','ProductController');
    Route::get('/', 'DashboardController@index')->name('admin.dashborad');
    // Route::get('/', [DashboardController::class, 'index'])->name('admin.dashborad');
    Route::get('changemode', [DashboardController::class, 'change_mode'])->name('admin.dashborad.changemode');
    ################################### Begin Language Routes #################################################
    // Route::group(['prefix' => 'language'], function () {
    // Route::get('/language', [LanguageController::class, 'index'])->name('admin.language');

    // Route::get('language/create', [LanguageController::class, 'create'])->name('admin.language.create');
    // Route::post('language/store', [LanguageController::class, 'store'])->name('admin.language.store');

    // Route::get('language/edit/{id}', [LanguageController::class, 'edit'])->name('admin.language.edit');
    // Route::post('language/update/{id}', [LanguageController::class, 'update'])->name('admin.language.update');

    // Route::post('delete', [LanguageController::class, 'delete'])->name('admin.language.delete');
    // Route::post('delete',[LanguageController::class ,'delete'])->name('admin.language.delete');
    // });
    ################################### End Language Routes ###################################################


    ################################### Begin Settings Routes #################################################
    Route::group(['prefix' => 'setting'], function () {
        // Setting/add_grades
        Route::group(['prefix' => 'supervisor'], function () {

            // Route::get('/', [UserController::class, 'index'])->name('admin.users.all');
            Route::get('all', [SuperviserController::class, 'all'])->name('admin.supervisor.all');
            Route::get('add', [SuperviserController::class, 'create'])->name('admin.supervisor.add');
            Route::post('store', [SuperviserController::class, 'store'])->name('admin.supervisor.store');

            Route::get('edit/{admin_id}', [SuperviserController::class, 'edit'])->name('admin.supervisor.edit');
            Route::post('update-info', [SuperviserController::class, 'update_info'])->name('admin.supervisor.update.info');
            Route::post('delete-supervisor', [SuperviserController::class, 'delete_supervisor'])->name('admin.supervisor.delete.supervisor');

            // Route::get('edit/{id}',[UserController::class ,'edit'])->name('admin.language.edit');
            // Route::post('update/{id}',[UserController::class ,'update'])->name('admin.language.update');

            // Route::post('delete',[UserController::class ,'delete'])->name('admin.language.delete');
            // Route::post('delete',[LanguageController::class ,'delete'])->name('admin.language.delete');
        });



        Route::get('/language', [LanguageController::class, 'index'])->name('admin.language');

        Route::get('language/create', [LanguageController::class, 'create'])->name('admin.language.create');
        Route::post('language/store', [LanguageController::class, 'store'])->name('admin.language.store');

        Route::get('language/edit/{id}', [LanguageController::class, 'edit'])->name('admin.language.edit');
        Route::post('language/update/{id}', [LanguageController::class, 'update'])->name('admin.language.update');


        ################################### begin roles and permmission  Routes ###################################################

        Route::get('role', [RoleAndPermissionController::class, 'all_role'])->name('admin.setting.role');
        Route::get('get-permmision', [RoleAndPermissionController::class, 'get_permission'])->name('admin.setting.get.permission');
        Route::post('new-role', [RoleAndPermissionController::class, 'new_role'])->name('admin.setting.new.role');
        Route::post('get_permission_for_role/{role_id}', [RoleAndPermissionController::class, 'get_permission_for_role'])->name('admin.setting.get.permission.for.role');
        Route::post('update_permission_for_role', [RoleAndPermissionController::class, 'update_permission_for_role'])->name('admin.setting.update.permission.for.role');
        ################################### End of  roles and permmission  Routes ###################################################

        ###########################  for grades setting
        Route::get('add_grades', [GradeController::class, 'create'])->name('admin.grades.add');
        Route::post('grade_store', [GradeController::class, 'store'])->name('admin.grades.store');
        Route::post('grade_delete', [GradeController::class, 'delete'])->name('admin.grades.delete');
        Route::post('grade_update', [GradeController::class, 'update'])->name('admin.grades.update');

        ###########################  for level setting
        Route::get('add_levels', [LevelController::class, 'create'])->name('admin.level.add');
        Route::post('store_level', [LevelController::class, 'store'])->name('admin.level.store');
        // Route::post('grade_delete', [LevelController::class, 'delete'])->name('admin.grades.delete');
        Route::post('level_update', [LevelController::class, 'update'])->name('admin.level.update');
        Route::post('delet', [LevelController::class, 'delete'])->name('admin.level.delet');

        ###########################  for Currency setting
        Route::get('currency', [CurrencyController::class, 'index'])->middleware(['permission:activate_currency'])->name('admin.Currency.get');
        Route::post('currency_activate', [CurrencyController::class, 'activate'])->name('admin.Currency.active.disactive');

        ###########################  for services setting
        Route::get('services', [ServicesController::class, 'create'])->name('admin.Services.add');
        Route::post('store', [ServicesController::class, 'store'])->name('admin.Services.store');

        ###########################  for fee type setting
        Route::get('fee_type', [FeetypeController::class, 'index'])->name('admin.setting.fee');
        Route::post('store_fee_type', [FeetypeController::class, 'store'])->name('admin.setting.fee.store');
        Route::post('delete_fee_type', [FeetypeController::class, 'delete'])->name('admin.setting.fee.delete');
    });
    ################################### End Settings Routes ###################################################

    ################################### Begin Cours Routes #################################################
    Route::group(['prefix' => 'cours'], function () {
        Route::get('/', [CoursController::class, 'index'])->name('admin.cours.all');
        Route::get('create', [CoursController::class, 'create'])->name('admin.cours.add');
        Route::post('store', [CoursController::class, 'store'])->name('admin.cours.store');
        Route::get('edit/{id}', [CoursController::class, 'edit'])->name('admin.cours.edit');
        Route::post('update/{id}', [CoursController::class, 'update'])->name('admin.cours.update');
        // Route::get('ppp', [ShowPosts::class, 'render']);

        Route::get('fee/{id}', [CoursController::class, 'edit'])->name('admin.cours.get.fee');
    });

    ################################### End Cours Routes ###################################################


    ################################### Begin Students Routes #################################################
    Route::group(['prefix' => 'students'], function () {
        Route::get('/', [StudentsController::class, 'students'])->name('admin.students.all');
        //Route::get('Registration', [Registration::class,'render'])->name('admin.students.register');
        Route::view('Registration', 'admin.livewire.students.std_registration')->name('admin.students.Registration-1');
        Route::get('payment', [StudentsController::class, 'get_std_to_payment'])->name('admin.students.get_std_to_payment');
        Route::post('get_cours_std/{id}', [StudentsController::class, 'get_cours_std'])->name('admin.students.get_cours_std');

        Route::get('Receipt', [ReceiptController::class, 'All_receipt'])->name('admin.all-receipt');
        Route::get('edit-old-payment/{receipt_id}', [PaymentController::class, 'edit_payment'])->name('admin.students.payment.edit');
        Route::post('delet_receipt', [PaymentController::class, 'delete_payment_receipt'])->name('admin.students.delete_payment_receipt');
        Route::get('new-registration-order', [AdminNotificationController::class, 'new_register'])->name('admin.new.register.order');
        Route::post('approve-user-register', [RegistartionStudentsController::class, 'approve_user_register'])->name('admin.notification.approve.user');
        Route::post('approve-new-register', [RegistartionStudentsController::class, 'approve_edit_register'])->name('admin.notification.approve.edit.register');
        Route::post('approved', [RegistartionStudentsController::class, 'approved_new_register'])->name('admin.notification.approve.new.register');


        // Route::get('Payment/edit/{user_id}/{cours_id}/{receipt_id}', [StudentsController::class, 'get_std_to_payment'])
        //     ->name('admin.students.get_std_to_payment');
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
        ###########################################################################################
        // Route::get('PaymentCoursFee/{registration_id}', [Payment::class,'render'])->name('admin.payment.feeCours');
    });

    ################################### end  Payment Routes #################################################


    ################################### Begin Services  Routes #################################################

    Route::group(['prefix' => 'services'], function () {

        // Route::get('services/', [ServicesController::class, 'create'])->name('admin.Services.add');
        // Route::post('store',  [ServicesController::class, 'store'])->name('admin.Services.store');
        Route::post('services_delete', [ServicesController::class, 'delete'])->name('admin.services.delete');
        Route::post('get-services-update/{services_id}', [ServicesController::class, 'to_update'])->name('admin.services.to-update');
        Route::post('update', [ServicesController::class, 'update'])->name('admin.services.update');
        // C:\xampp\htdocs\sis\resources\views\admin\livewire\services\servicesclient.blade.php
        Route::view('client', 'admin.livewire.services.services-to-client')->name('admin.Services.to.client');
        Route::get('receipt', [ServicesReceiptController::class, 'All_receipt'])->name('admin.Services.all-receipt');

        // Route::get('services/{user_service_id}', [ClientPaymentController::class, 'user_paid_for_services1'])->name('admin.payment.user_paid_for_services1');
        Route::get('services/{user_service_id}', [ClientPaymentController::class, 'user_paid_for_services'])->name('admin.payment.user_paid_for_services');
        Route::post('save_payment_client', [ClientPaymentController::class, 'savepaymentCient'])->name('admin.payment.payment_client_to_receipt');
        // Route::get('receipt', [ServicesReceiptController::class, 'all_receipt'])->name('admin.Services..allreceipt');
        Route::post('delet_receipt', [ServicesReceiptController::class, 'delete_payment_receipt'])->name('admin.service.delete_payment_receipt');
        Route::get('edit-old-payment/{receipt_id}', [ClientPaymentController::class, 'get_old_payment'])->name('admin.service.get_old_payment.edit');
        Route::post('edit-payment', [ClientPaymentController::class, 'edit_payment'])->name('admin.service.edit.old.payment');
    });
    ################################### end  Services Routes #################################################
    Route::group(['prefix' => 'reports'], function () {
        Route::get('/', [ReportsController::class, 'index'])->name('admin.report');
        Route::post('daily-report', [ReportsController::class, 'daily_report'])->name('admin.daily.report');
        Route::post('distrubtion', [ReportsController::class, 'dist_'])->name('admin.distrubtion.report');
        Route::post('service-by-type', [ReportsController::class, 'service_by_type'])->name('admin.service.by.type.report');
    });


    Route::group(['prefix' => 'users'], function () {

        Route::get('/', [UserController::class, 'index'])->name('admin.users.all');
        Route::get('add', [UserController::class, 'create'])->middleware(['permission:edit'])->name('admin.users.add');
        // Route::post('store',[UserController::class ,'store'])->name('admin.language.store');

        // Route::get('edit/{id}',[UserController::class ,'edit'])->name('admin.language.edit');
        // Route::post('update/{id}',[UserController::class ,'update'])->name('admin.language.update');

        // Route::post('delete',[UserController::class ,'delete'])->name('admin.language.delete');
        Route::post('delete', [LanguageController::class, 'delete'])->name('admin.language.delete');
    });
    ################################### End Language Routes ###################################################

    ################################### End Language Routes ###################################################


    Route::group(['prefix' => 'notification'], function () {

        // Route::get('/', [UserController::class, 'index'])->name('admin.users.all');
        Route::get('all', [AdminNotificationController::class, 'all'])->name('admin.notification.all');
        Route::get('new-register', [AdminNotificationController::class, 'new_register'])->name('admin.notification.new.register');
        Route::post('get_user_info/{orders_id}', [AdminNotificationController::class, 'user_info_with_cours'])->name('admin.notification.get.user.info');
        Route::post('delete-marked', [AdminNotificationController::class, 'delete_marked'])->name('admin.notification.delete.marked');
        Route::post('deny-marked', [AdminNotificationController::class, 'deny_marked'])->name('admin.notification.deny.marked');
        Route::post('read-marked', [AdminNotificationController::class, 'read_marked'])->name('admin.notification.read.marked');
        Route::post('approve-marked', [AdminNotificationController::class, 'approve_marked'])->name('admin.notification.approve.marked');
        // Route::post('store', [SuperviserController::class, 'store'])->name('admin.supervisor.store');

        // Route::get('edit/{id}',[UserController::class ,'edit'])->name('admin.language.edit');
        // Route::post('update/{id}',[UserController::class ,'update'])->name('admin.language.update');

        // Route::post('delete',[UserController::class ,'delete'])->name('admin.language.delete');
        // Route::post('delete',[LanguageController::class ,'delete'])->name('admin.language.delete');
    });
    ################################### End notification Routes ###################################################


});
