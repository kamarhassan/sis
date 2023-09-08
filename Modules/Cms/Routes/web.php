<?php

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


use Modules\Cms\Http\Controllers\FrontEnd\CommentController;
use Modules\Cms\Http\Controllers\FrontEnd\FrontBlogController;
use Modules\Cms\Http\Controllers\FrontEnd\FrontPageController;
use Modules\Cms\Http\Controllers\FrontEnd\MenuBuilderController;


include('admin.php');

Route::prefix('cms')->group(function () {
   Route::get('/', 'CmsController@index');
   Route::get('render-menu-in-front', [MenuBuilderController::class, 'render_menu_in_front'])->name('render-menu-in-front');
   Route::get('post/{slug}', [FrontBlogController::class, 'show'])->name('cms.web.blog.post.detail');
   Route::get('news', [FrontBlogController::class, 'index'])->name('cms.web.blog.index');
});
Route::get('/{slug}', [FrontPageController::class, 'show_page_in_front'])->name('cms.web.front.page.show');



Route::middleware(['auth', 'verified'])->group(function () {
   
   
   Route::post('post-comment', [CommentController::class, 'post_comment'])->name('cms.web.front.comment.post');
   Route::post('edit-comment', [CommentController::class, 'edit_comment'])->name('cms.web.front.comment.post.edit');
   Route::post('replay-comment', [CommentController::class, 'replay_comment'])->name('cms.web.front.comment.replay');
   Route::post('delet-comment', [CommentController::class, 'delete_comment'])->name('cms.web.front.comment.delete');



});