<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoriesController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'categories'], function () {
              
    Route::get('/', [CategoriesController::class, 'index'])/*->middleware(['permission:edit certificate |create certificate |delete certificate']) */->name('api.categorie.all');
    Route::get('/{categories_id}', [CategoriesController::class, 'show_categorie_details'])/*->middleware(['permission:edit certificate |create certificate |delete certificate']) */->name('api.show.categorie.details');
   
    //  Route::get('/new', [CertificateController::class, 'create'])->middleware(['permission:create certificate'])->name('admin.certificate.new');
    //  Route::post('store-certificate', [CertificateController::class, 'store_certificate'])->middleware(['permission:create certificate'])->name('admin.certificate.store.certificate');
    //  Route::post('delete-certificate', [CertificateController::class, 'delete_certificate'])->middleware(['permission:delete certificate'])->name('admin.certificate.delete.certificate');
    //  Route::get('edit/{id}', [CertificateController::class, 'edit_certificate'])->middleware(['permission:edit certificate'])->name('admin.certificate.edit.certificate');
    //  Route::post('store-edit-certificate', [CertificateController::class, 'save_edit_certificate'])->middleware(['permission:edit certificate'])->name('admin.certificate.save.edit.certificate');
 });
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
