<?php

use App\Http\Controllers\Admin\ArtisanCommandController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\loginController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SuperviserController;
// use Mcamara\LaravelLocalization\LaravelLocalization;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




Route::group(
   [
      'namespace' => 'Admin',
      'prefix' => LaravelLocalization::setLocale() . '/admin',
      'middleware' => ['guest:admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
   ],
   function () {
      Route::get('/builder', function () {
         return view('admin.builder');
      });


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

   ################################### Begin Language Routes #################################################

   ################################### Begin Settings Routes #################################################

   Route::get('changemode', [DashboardController::class, 'change_mode'])->name('admin.dashborad.changemode');
   Route::get('/cmd/{index}', [ArtisanCommandController::class, 'command'])->name('admin.setting.artisan');
   Route::post('changeyear', [DashboardController::class, 'changeyear'])->name('admin.change.years');
   

   include('AdminRoutes/CoursRoutes.php');
   include('AdminRoutes/SettingRoutes.php');
   include('AdminRoutes/StudentsRoutes.php');
   include('AdminRoutes/MarksRoutes.php');
   include('AdminRoutes/Payment.php');
   include('AdminRoutes/Teacher.php');
   include('AdminRoutes/Reports.php');
   include('AdminRoutes/Services.php');
   include('AdminRoutes/Profile.php');
   include('AdminRoutes/Users.php');
   include('AdminRoutes/NotificationRoutes.php');
   

  




//    Route::get('/builder', function () {
//       return view('admin.builder');
//   });


});
