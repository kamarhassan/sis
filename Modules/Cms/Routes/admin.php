<?php


use Illuminate\Support\Facades\Route;


use Modules\Cms\Http\Controllers\Admin\BlogController;
use Modules\Cms\Http\Controllers\Admin\FrontPageController;
use Modules\Cms\Http\Controllers\Admin\MenuBuilderController;
use Modules\Cms\Http\Controllers\Admin\BlogCategoryController;
use Modules\Cms\Http\Controllers\Admin\FooterSettingController;

Route::group(
   [

      'prefix' => LaravelLocalization::setLocale() . '/admin/cms',
      'middleware' => ['auth:admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
   ],
   function () {
      Route::get('/', 'CmsController@index');
      Route::get('menu', [MenuBuilderController::class, 'index'])->name('cms.admin.menu')->middleware(['permission:create menu|edit menu|delete menu']);
      Route::post('menu-post', [MenuBuilderController::class, 'store'])->name('cms.admin.post.menu')->middleware(['permission:create menu']);
      Route::post('/headermenu-add', [MenuBuilderController::class, 'addElement'])->name('cms.headermenu.add-element')->middleware(['permission:create menu']); //->middleware('RoutePermissionCheck:cms.headermenu.add-element');
      Route::post('/headermenu-edit', [MenuBuilderController::class, 'editElement'])->name('cms.headermenu.edit-element')->middleware(['permission:edit menu']); //->middleware('RoutePermissionCheck:cms.headermenu.edit-element');
      Route::post('/headermenu-reordering', [MenuBuilderController::class, 'reordering'])->name('cms.headermenu.reordering')->middleware(['permission:edit menu']); //->middleware('RoutePermissionCheck:cms.headermenu.reordering');
      Route::post('/headermenu-delete', [MenuBuilderController::class, 'deleteElement'])->name('cms.headermenu.delete')->middleware(['permission:delete menu']); //->middleware('RoutePermissionCheck:frontend.headermenu.delete');

      // Route::get('/mani', [LaravelPWAController::class, 'manifestJson'])->name('manifestJson');

      Route::group(['prefix' => 'page'], function () {
         Route::get('/', [FrontPageController::class, 'index'])->name('cms.admin.page')
            ->middleware(['permission:create page|edit page|delete page']);

         Route::get('create', [FrontPageController::class, 'create'])->name('cms.admin.page.create')->middleware(['permission:create page']);
         Route::post('store-page', [FrontPageController::class, 'store'])->name('cms.admin.page.store')->middleware(['permission:create page']);

         Route::get('/{page_id}', [FrontPageController::class, 'show'])->name('cms.admin.page.show');


         Route::post('destroy', [FrontPageController::class, 'destroy'])->name('cms.admin.page.destroy')->middleware(['permission:delete page']);
         Route::get('edit/{id}', [FrontPageController::class, 'edit'])->name('cms.admin.page.edit')->middleware(['permission:edit page']);
         Route::post('edit-page', [FrontPageController::class, 'update'])->name('cms.admin.page.update')->middleware(['permission:edit page']);
      });


      Route::group(['prefix' => 'footer'], function () {
         //footer setting
         Route::get('/footer-setting', [FooterSettingController::class, 'index'])->name('footerSetting.footer.index');

         Route::post('/footer-setting', [FooterSettingController::class, 'contentUpdate'])->name('footerSetting.footer.content-update');
         Route::get('/footer-setting/tab/{id}', [FooterSettingController::class, 'tabSelect'])->name('footerSetting.footer.content-tabselect');

         Route::post('/footer-widget', [FooterSettingController::class, 'widgetStore'])->name('footerSetting.footer.widget-store');
         Route::post('/footer-widget-status', [FooterSettingController::class, 'widgetStatus'])->name('footerSetting.footer.widget-status');
         Route::post('/footer-widget-update', [FooterSettingController::class, 'widgetUpdate'])->name('footerSetting.footer.widget-update');
         Route::post('/footer-widget-delete', [FooterSettingController::class, 'destroy'])->name('footerSetting.footer.widget-delete');
      });



      Route::group(['prefix' => 'blogs'], function () {
     
         Route::get('/', [BlogController::class, 'index'])->name('cms.blogs.index')
         // ->middleware('RoutePermissionCheck:blogs.index');
         ;
       
         Route::get('create', [BlogController::class, 'create'])->name('cms.blogs.create')
         // ->middleware('RoutePermissionCheck:blogs.store');
         ;  
           Route::post('post_blogs', [BlogController::class, 'store'])->name('cms.blogs.store')
         // ->middleware('RoutePermissionCheck:blogs.store');
         ;
       
         Route::get('edit/{id}', [BlogController::class, 'edit'])->name('cms.blogs.edit')
         // ->middleware('RoutePermissionCheck:blogs.update');
         ;
         Route::post('update', [BlogController::class, 'update'])->name('cms.blogs.update')
         // ->middleware('RoutePermissionCheck:blogs.update');
         ;
         Route::post('destroy', [BlogController::class, 'destroy'])->name('cms.blogs.destroy')
         // ->middleware('RoutePermissionCheck:blogs.destroy');
;

         Route::get('blog-category', [BlogCategoryController::class, 'index'])->name('cms.blog-category.index')
         // ->middleware('RoutePermissionCheck:blog-category.index');
         ;
         Route::post('blog-category', [BlogCategoryController::class, 'store'])->name('cms.blog-category.store')
         // ->middleware('RoutePermissionCheck:blog-category.store');
         ;
         Route::get('blog-category/{id}', [BlogCategoryController::class, 'edit'])->name('cms.blog-category.edit')
         // ->middleware('RoutePermissionCheck:blog-category.update');
         ;
         Route::post('blog-category/update', [BlogCategoryController::class, 'update'])->name('cms.blog-category.update')
         // ->middleware('RoutePermissionCheck:blog-category.update');
         ;
         Route::get('blog-category/destroy/{id}', [BlogCategoryController::class, 'destroy'])->name('cms.blog-category.destroy')
         // ->middleware('RoutePermissionCheck:blog-category.destroy');
      ;});

   }
);
