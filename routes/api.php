<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\API\SliderController;
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
Route::group(['prefix' => 'cours'], function () {    
    Route::get('/', [CategoriesController::class, 'index'])/*->middleware(['permission:edit certificate |create certificate |delete certificate']) */->name('api.categorie.first.10');
    Route::get('all', [CategoriesController::class, 'all'])/*->middleware(['permission:edit certificate |create certificate |delete certificate']) */->name('api.categorie.all');
    Route::get('/{categories_id}', [CategoriesController::class, 'show_categorie_details'])/*->middleware(['permission:edit certificate |create certificate |delete certificate']) */->name('api.show.categorie.details');
});


Route::get('slider', [SliderController::class, 'AllActive'])/*->middleware(['permission:edit certificate |create certificate |delete certificate']) */->name('api.slider.all.active');

Route::middleware('auth:api')->get('/user', function (Request $request) {
   return $request->user();
});

Route::middleware(['auth', 'verified'])->group(function () {
   Route::get('user-info', [UserController::class, 'get_info'])/*->middleware(['permission:edit certificate |create certificate |delete certificate']) */->name('api.user.info');
    
});



