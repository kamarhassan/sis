<?php

use App\Http\Livewire\Count;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\FrontEnd\IndexController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\FrontEnd\ContactUsController;
use App\Http\Controllers\FrontEnd\OurTeamController;
use LaravelPWA\Http\Controllers\LaravelPWAController;
use App\Http\Controllers\FrontEnd\CategoriesController;
use App\Http\Controllers\FrontEnd\CertificateController;
use App\Http\Controllers\FrontEnd\CoursDetailController;
use App\Http\Controllers\FrontEnd\RegisterCoursController;
use App\Http\Controllers\FrontEnd\UserDashboradController;
use App\Http\Controllers\FrontEnd\StudentProfileController;
use App\Http\Controllers\FrontEnd\Api\SocialLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//    return redirect('http://localhost/wp');
// });

// Route::get('/mani', [LaravelPWAController::class, 'manifestJson'])->name('manifestJson');

Route::group(
   [
      //      'prefix' => LaravelLocalization::setLocale(),
      //      'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
   ],
   function () {

      Route::get('/', [IndexController::class, 'index'])->name('web.index');
      // Route::get('page/{slug}', [IndexController::class, 'show_page_in_front'])->name('web.index.page');

      Route::get('/home', [HomeController::class, 'index'])->name('web.home');
      Route::get('/contact-us', [ContactUsController::class, 'index']);
      Route::post('save-contact-us', [ContactUsController::class, 'save'])->name('web.post.contact-us');

      Route::get('/our-team', [OurTeamController::class, 'index']);
     




      // Auth::routes();


      Route::group(['prefix' => 'certificate'], function () {
         Route::get('/{barcode}', [CertificateController::class, 'get_student_cetificate_by_barcode_scan'])->name('web.searche.certificate.by.barcode.scan');
         // Route::get('/-barcode', [CertificateController::class, 'get_student_cetificate_by_barcode'])->name('web.searche.certificate.by.barcode');
         Route::post('/-post-barcode', [CertificateController::class, 'searche_and_get_student_cetificate_by_barcode'])->name('web.get.certificate.by.barcode');

         Route::get('/{certificate_name}/{cert_id}', [CertificateController::class, 'certificate_detail'])
            /*->middleware(['permission:edit certificate |create certificate |delete certificate']) */->name('certificate.detail');
      });

      Route::group(['prefix' => 'course'], function () {
         Route::get('/', [CategoriesController::class, 'index'])/*->middleware(['permission:edit certificate |create certificate |delete certificate']) */->name('web.cours.all');
         Route::get('/{categories_id}', [CategoriesController::class, 'show_categorie_details_by_id'])
            /*->middleware(['permission:edit certificate |create certificate |delete certificate']) */->name('show.categorie.details_by_id');
         Route::get('related/{tag}', [CategoriesController::class, 'show_related_category_of_tag'])
            /*->middleware(['permission:edit certificate |create certificate |delete certificate']) */->name('show.related.category.of.tag');
         Route::get('class/{category}/{grade_level}/{coursid}', [CoursDetailController::class, 'cours_details'])->name('web.cours-details');
      });


      Auth::routes(['verify' => true]);

      Route::get('auth/google', [SocialLoginController::class, 'redirecttogoogle'])->name('user.login.by.google');
      Route::get('auth/google/callback', [SocialLoginController::class, 'handleGooglecallback'])->name('user.login.by.fb');
      Route::middleware(['auth', 'verified'])->group(function () {
         Route::get('profile-not-complete', [StudentProfileController::class, 'complete_profile'])->name('web.profile.must.complete');
         Route::get('edit-profile-to-complete', [StudentProfileController::class, 'edit_profile_complete'])->name('web.edit-profile.to.complete');
         // Route::post('save-profile-not-complete', [StudentProfileController::class, 'save_profile_complete'])->name('web.save-profile.to.complete');
         Route::post('save-profile-not-complete', [StudentProfileController::class, 'post'])->name('web.save-profile.to.complete');
         Route::post('post-password', [StudentProfileController::class, 'post_password'])->name('web.post.student.profile.password');
    
    
      });
   
   
   
      Route::middleware(['auth', 'verified', 'CheckUserProfileCompleteness'])->group(function () {

         Route::get('my-cours', [UserDashboradController::class, 'index'])->name('web.dashboard');
         Route::get('my-cours', [UserDashboradController::class, 'user_cours_reserved'])->name('web.user.cours');
         Route::post('delete', [RegisterCoursController::class, 'delete_cours_reserved'])->name('web.delete.cours.reserved');
         Route::post('register-cours', [RegisterCoursController::class, 'RegisterCours'])->name('web.registerCours');



         Route::prefix('my-dashboard')->group(function () {
            Route::get('/', [UserDashboradController::class, 'index'])->name('web.user.dashboard');
            Route::prefix('cours')->group(function () {
               Route::get('/', [UserDashboradController::class, 'cours'])->name('web.user.cours');
               Route::get('certificate/{cours_id}/{certeficate_id}', [CertificateController::class, 'certificate'])->name('web.user.cours.get.certificate');
               Route::get('reserved', [UserDashboradController::class, 'user_cours_reserved'])->name('web.user.cours.reserved');
            });

            Route::prefix('profile')->group(function () {
               // Route::get('profile',[UserController::class,'profile'])->name('web.user.profile');
               Route::get('/', [StudentProfileController::class, 'index'])->name('web.student.profile');
               Route::post('post-profile', [StudentProfileController::class, 'post'])->name('web.post.student.profile');
               Route::post('post-password', [StudentProfileController::class, 'post_password'])->name('web.post.student.profile.password');
            });
         });
      });
   }
);
