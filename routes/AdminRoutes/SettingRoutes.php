<?php


use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\FeetypeController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\SuperviserController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\CertificatetemplatesController;
use App\Http\Controllers\Admin\SponsoreTypeController;
use App\Http\Controllers\Admin\RoleAndPermissionController;
use App\Http\Controllers\Admin\Services\ServicesController;
use App\Http\Controllers\Admin\InstitueInformationController;
use App\Http\Controllers\Admin\SchoolYearController;

Route::group(['prefix' => 'setting'], function () {
   Route::group(['prefix' => 'supervisor'], function () {
      Route::get('all', [SuperviserController::class, 'all'])
         ->middleware(['permission:edit supervisor|delete supervisor'])->name('admin.supervisor.all');

      Route::get('add', [SuperviserController::class, 'create'])
         ->middleware(['permission:add supervisor'])->name('admin.supervisor.add');

      Route::post('store', [SuperviserController::class, 'store'])
         ->middleware(['permission:add supervisor'])->name('admin.supervisor.store');

      Route::get('edit/{admin_id}', [SuperviserController::class, 'edit'])
         ->middleware(['permission:edit supervisor'])->name('admin.supervisor.edit');

      Route::post('update-info', [SuperviserController::class, 'update_info'])
         ->middleware(['permission:edit supervisor'])->name('admin.supervisor.update.info');

      Route::post('delete-supervisor', [SuperviserController::class, 'delete_supervisor'])
         ->middleware(['permission:delete supervisor'])->name('admin.supervisor.delete.supervisor');
   });


   Route::group(['prefix' => 'sponsor'], function () {
      Route::get('/', [SponsorController::class, 'index'])
         ->middleware(['permission:edit sponsor|delete sponsor|add sponsor'])->name('admin.sponsor.all');

      Route::post('store-sponsor', [SponsorController::class, 'store_sponsor'])
         ->middleware(['permission:add sponsor'])->name('admin.sponsor.store.sponsor');

      Route::post('delete-sponsor', [SponsorController::class, 'delete_sponsor'])
         ->middleware(['permission:delete sponsor'])->name('admin.sponsor.delete.sponsor');
   });


   Route::group(['prefix' => 'certificate'], function () {

      Route::get('/', [CertificateController::class, 'index'])
         ->middleware(['permission:edit certificate |create certificate |delete certificate'])->name('admin.certificate.all');

      Route::get('/new', [CertificateController::class, 'create'])
         ->middleware(['permission:create certificate'])->name('admin.certificate.new');

      Route::post('store-certificate', [CertificateController::class, 'store_certificate'])
         ->middleware(['permission:create certificate'])->name('admin.certificate.store.certificate');

      Route::post('delete-certificate', [CertificateController::class, 'delete_certificate'])
         ->middleware(['permission:delete certificate'])->name('admin.certificate.delete.certificate');

      Route::get('edit/{id}', [CertificateController::class, 'edit_certificate'])
         ->middleware(['permission:edit certificate'])->name('admin.certificate.edit.certificate');

      Route::post('store-edit-certificate', [CertificateController::class, 'save_edit_certificate'])
         ->middleware(['permission:edit certificate'])->name('admin.certificate.save.edit.certificate');


      Route::group(['prefix' => 'templates'], function () {

         Route::get('/', [CertificatetemplatesController::class, 'index'])
            ->name('admin.certificate.templates.all');
         Route::get('create', [CertificatetemplatesController::class, 'create'])
            ->name('admin.certificate.templates.create');
         Route::get('edit/{template_id}', [CertificatetemplatesController::class, 'edit'])
            ->name('admin.certificate.templates.edit');
         Route::post('craete-update-certeficate-templates', [CertificatetemplatesController::class, 'create_update'])
            ->name('admin.certificate.templates.create.update');
         Route::post('delete-templates', [CertificatetemplatesController::class, 'delete'])
            ->name('admin.certificate.templates.delete');
      });
   });

   Route::group(['prefix' => 'cours'], function () {
      Route::get('/', [CategoriesController::class, 'index'])/*
      ->middleware(['permission:edit certificate|delete certificate|add certificate'])*/->name('admin.categories.all');

      Route::get('/new', [CategoriesController::class, 'create'])/*
      ->middleware(['permission:edit certificate|delete certificate|add certificate'])*/->name('admin.categories.new');

      Route::post('store-categories', [CategoriesController::class, 'store_categories'])/*
      ->middleware(['permission:add sponsor'])*/->name('admin.categories.store.categories');

      Route::post('delete-categories', [CategoriesController::class, 'delete_categories'])/*
      ->middleware(['permission:delete sponsor'])*/->name('admin.categories.delete.categories');

      Route::get('edit/{id}', [CategoriesController::class, 'edit_categories'])/*
      ->middleware(['permission:delete sponsor'])*/->name('admin.categories.edit.categories');

      Route::post('post-edit', [CategoriesController::class, 'save_edit_category'])/*
      ->middleware(['permission:delete sponsor'])*/->name('admin.categories.post.edit.categories');

      Route::post('delete-categories-image', [CategoriesController::class, 'delete_image_categories'])/*
      ->middleware(['permission:delete sponsor'])*/->name('admin.categories.delete.image');

      Route::post('delete-categories-image-from-callery', [CategoriesController::class, 'delete_image_categories_from_callery'])/*
      ->middleware(['permission:delete sponsor'])*/->name('admin.categories.delete.image_from_callery');

      // Route::post('store-edit-certificate', [CertificateController::class, 'save_edit_certificate'])/*
      // ->middleware(['permission:delete sponsor'])*/->name('admin.certificate.save.edit.certificate');
   });


   Route::group(['prefix' => 'institue-information'], function () {
      Route::get('/', [InstitueInformationController::class, 'index'])
         ->middleware(['permission:edit institue information|delete institue information|add institue information'])->name('admin.institue.all');

      Route::get('/new', [InstitueInformationController::class, 'create'])
         ->middleware(['permission:add institue information'])->name('admin.InstitueInformation.new');

      Route::post('store-institue-information', [InstitueInformationController::class, 'store_InstitueInformation'])
         ->middleware(['permission:add institue information'])->name('admin.InstitueInformation.store.InstitueInformation');

      Route::post('delete-Institue-Information', [InstitueInformationController::class, 'delete_InstitueInformation'])
         ->middleware(['permission:delete institue information'])->name('admin.InstitueInformation.delete.InstitueInformation');

      Route::get('edit/{id}', [InstitueInformationController::class, 'edit'])
         ->middleware(['permission:edit institue information'])->name('admin.InstitueInformation.edit.InstitueInformation');

      Route::post('post-edit', [InstitueInformationController::class, 'save_edit'])
         ->middleware(['permission:edit institue information'])->name('admin.InstitueInformation.post.edit.InstitueInformation');
   });


   Route::group(['prefix' => 'slider'], function () {
      Route::get('/', [SliderController::class, 'index'])
         ->middleware(['permission:edit slider|delete slider|add slider'])->name('admin.slider.all');

      Route::get('/new', [SliderController::class, 'create'])
         ->middleware(['permission:add slider'])->name('admin.slider.new');

      Route::post('store-slider', [SliderController::class, 'store_slider'])
         ->middleware(['permission:add slider'])->name('admin.slider.store.slider');

      Route::post('delete-slider', [SliderController::class, 'delete_slider'])
         ->middleware(['permission:delete slider'])->name('admin.slider.delete.slider');

      Route::get('edit/{id}', [SliderController::class, 'edit'])
         ->middleware(['permission:edit slider'])->name('admin.slider.edit.slider');

      Route::post('post-edit', [SliderController::class, 'save_edit'])
         ->middleware(['permission:edit slider'])->name('admin.slider.post.edit.slider');
   });


   Route::group(['prefix' => 'sponsorfeetype'], function () {

      Route::get('/', [SponsoreTypeController::class, 'index'])/*
      ->middleware(['permission:edit slider|delete slider|add slider'])*/->name('admin.sponsorefeetype.all');

      // Route::get('/new', [SponsoreTypeController::class, 'create'])/* ->middleware(['permission:add sponsor fee type'])*/->name('admin.sponsorefeetype.new');

      // Route::post('store-slider', [SliderController::class, 'store_slider'])->middleware(['permission:add slider'])->name('admin.sponsorefeetype.store.slider');

      // Route::post('delete-slider', [SliderController::class, 'delete_slider'])->middleware(['permission:delete slider'])->name('admin.sponsorefeetype.delete.slider');

      // Route::get('edit/{id}', [SliderController::class, 'edit']) ->middleware(['permission:edit slider'])->name('admin.sponsorefeetype.edit.slider');

      // Route::post('post-edit', [SliderController::class, 'save_edit'])->middleware(['permission:edit slider'])->name('admin.sponsorefeetype.post.edit.slider');


   });





   ################################### begin Language  Routes ###################################################

   Route::get('/language', [LanguageController::class, 'index'])
      ->middleware(['permission:edit language'])->name('admin.language');

   Route::get('language/edit/{id}', [LanguageController::class, 'edit'])
      ->middleware(['permission:edit language'])->name('admin.language.edit');

   Route::post('language/update/{id}', [LanguageController::class, 'update'])
      ->middleware(['permission:edit language'])->name('admin.language.update');

   ################################### End Language  Routes ###################################################

   ################################### begin roles and permmission  Routes ###################################################
   Route::get('role', [RoleAndPermissionController::class, 'all_role'])
      ->middleware(['permission:create roles|edit roles|delete roles'])->name('admin.setting.role');

   Route::post('delete-role', [RoleAndPermissionController::class, 'delete_role'])
      ->middleware(['permission:delete roles'])->name('admin.setting.delete.role');

   Route::post('new-role', [RoleAndPermissionController::class, 'new_role'])
      ->middleware(['permission:create roles'])->name('admin.setting.new.role');

   Route::post('get_permission_for_role/{role_id}', [RoleAndPermissionController::class, 'get_permission_for_role'])
      ->middleware(['permission:edit roles'])->name('admin.setting.get.permission.for.role');

   Route::post('update_permission_for_role', [RoleAndPermissionController::class, 'update_permission_for_role'])
      ->middleware(['permission:edit roles'])->name('admin.setting.update.permission.for.role');

   ################################### End of  roles and permmission  Routes ###################################################

   ###########################  for grades setting
   Route::get('category', [GradeController::class, 'create'])
      ->middleware(['permission:create grades'])->name('admin.grades.add');

   Route::post('grade_store', [GradeController::class, 'store'])
      ->middleware(['permission:create grades'])->name('admin.grades.store');

   Route::post('grade_delete', [GradeController::class, 'delete'])
      ->middleware(['permission:delete grades'])->name('admin.grades.delete');

   Route::post('grade_update', [GradeController::class, 'update'])
      ->middleware(['permission:edit grades'])->name('admin.grades.update');

   Route::post('delete-img', [GradeController::class, 'delete_img'])
      ->middleware(['permission:edit grades'])->name('admin.grades.delete.image');

   Route::get('get-category-information/{cat_id}', [GradeController::class, 'get_category_information'])
      ->middleware(['permission:edit grades'])->name('admin.get.category.information');


   ###########################  for level setting
   Route::get('add_levels', [LevelController::class, 'create'])
      ->middleware(['permission:create levels|edit levels|delete levels'])->name('admin.level.add');

   Route::post('store_level', [LevelController::class, 'store'])
      ->middleware(['permission:create levels'])->name('admin.level.store');


   Route::post('level_update', [LevelController::class, 'update'])
      ->middleware(['permission:edit levels'])->name('admin.level.update');

   Route::post('delet', [LevelController::class, 'delete'])
      ->middleware(['permission:delete levels'])->name('admin.level.delet');


   ###########################  for Currency setting
   Route::get('currency', [CurrencyController::class, 'index'])
      ->middleware(['permission:activate_currency'])

      ->middleware(['permission:activate_currency'])->name('admin.Currency.get');

   Route::post('currency_activate', [CurrencyController::class, 'activate'])
      ->middleware(['permission:activate_currency'])->name('admin.Currency.active.disactive');


   ###########################  for services setting
   // 'create setting services', 'edit setting services', 'delete setting services'
   Route::get('services', [ServicesController::class, 'create'])
      ->middleware(['permission:create setting services|edit setting services|delete setting services'])->name('admin.Services.add');

   Route::post('store', [ServicesController::class, 'store'])
      ->middleware(['permission:create setting services'])->name('admin.Services.store');

   Route::post('services_delete', [ServicesController::class, 'delete'])
      ->middleware(['permission:delete setting services'])->name('admin.services.delete');

   Route::post('get-services-update/{services_id}', [ServicesController::class, 'to_update'])
      ->middleware(['permission:edit setting services'])->name('admin.services.to-update');

   Route::post('update', [ServicesController::class, 'update'])
      ->middleware(['permission:edit setting services'])->name('admin.services.update');

   ###########################  for fee type setting
   Route::get('fee_type', [FeetypeController::class, 'index'])
      ->middleware(['permission:edit fee type|create fee type|delete fee type'])->name('admin.setting.fee');

   Route::post('store_fee_type', [FeetypeController::class, 'store'])
      ->middleware(['permission:create fee type'])->name('admin.setting.fee.store');

   Route::post('delete_fee_type', [FeetypeController::class, 'delete'])
      ->middleware(['permission:delete fee type'])->name('admin.setting.fee.delete');



   Route::group(['prefix' => 'schoolyear'], function () {

      Route::get('/', [SchoolYearController::class, 'index'])
         ->middleware(['permission:add school year|edit school year|delete school year'])->name('admin.schoolyear.all');
   
         
      Route::post('post-save-edit', [SchoolYearController::class, 'save_edit'])
         ->middleware(['permission:add school year|edit school year|delete school year'])->name('admin.schoolyear.save.edit');
   
     Route::post('delete', [SchoolYearController::class, 'delete'])
         ->middleware(['permission:delete school year'])->name('admin.schoolyear.delete');
   
         Route::get('schoolyear-to-edit/{school_year_id}', [SchoolYearController::class, 'get_info_to_edit'])
         ->middleware(['permission:add school year|edit school year|delete school year'])->name('admin.schoolyear.get.to.edit');
   
         Route::post('change-current-school-years', [SchoolYearController::class, 'change_current_school_years'])
         ->middleware(['permission:edit school year'])->name('admin.schoolyear.change.current.school.years');
   
   
      });



});
