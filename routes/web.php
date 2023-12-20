<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BDController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserMenuController;
use App\Http\Controllers\WebUserController;
use Illuminate\Console\Application;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [App\Http\Controllers\PagesController::class, 'index'])->name('pages.index');
Route::get('/about', [App\Http\Controllers\PagesController::class, 'about'])->name('about');
Route::get('/services', [App\Http\Controllers\PagesController::class, 'services'])->name('services');
Route::get('/teams', [App\Http\Controllers\PagesController::class, 'teams'])->name('teams');
Route::get('/contact', [App\Http\Controllers\PagesController::class, 'contact'])->name('contact');
Route::get('/branch', [App\Http\Controllers\PagesController::class, 'branch'])->name('branch');
Route::post('/filter-branches', [App\Http\Controllers\PagesController::class, 'filterBranches'])->name('pages.filtered');
Route::get('/blog', [App\Http\Controllers\PagesController::class, 'blog'])->name('blog');
Route::get('/blog-details/{id}', [App\Http\Controllers\PagesController::class, 'blogid'])->name('blog-select');
Route::get('/warehouse-management', [App\Http\Controllers\PagesController::class, 'warehouse']);
Route::get('/transport-services', [App\Http\Controllers\PagesController::class, 'transport']);
Route::get('/other-services', [App\Http\Controllers\PagesController::class, 'other']);
Route::resource('/comment',CommentController::class);
Route::get('/inactivate',[App\Http\Controllers\Controller::class,'inactivate']);
Route::get('/error',[App\Http\Controllers\Controller::class,'error']);

Auth::routes();




Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/activity', [App\Http\Controllers\AdminController::class, 'activity'])->name('admin.activity');
Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::resource('/admin/user',WebUserController::class);
Route::resource('/admin/apps',ApplicationController::class);
Route::resource('/admin/menu',MenuController::class);
Route::resource('/admin/setting',SettingController::class);
Route::resource('/admin/gallery',GalleryController::class);
Route::resource('/admin/post',PostController::class);
Route::put('/admin/post-publish/{id}',[App\Http\Controllers\PostController::class,'publish']);
Route::resource('/admin/categorie', CategorieController::class);
//Route::get('/admin/gallery/{id}/image', [App\Http\Controllers\GalleryController::class, 'viewimage'])->name('admin.gallery.image');
Route::post('/admin/gallery/image/{id}', [App\Http\Controllers\GalleryController::class, 'addimage']);
Route::resource('/admin/branch', BranchController::class);
Route::get('/file-resize', [App\Http\Controllers\ResizeController::class, 'index']);
Route::post('/resize-file', [App\Http\Controllers\ResizeController::class, 'resizeImage'])->name('resizeImage');

Route::post('dropzone/upload', [App\Http\Controllers\GalleryController::class,'upload'])->name('dropzone.upload');

Route::get('dropzone/fetch/{id}/image', [App\Http\Controllers\GalleryController::class,'fetch'])->name('dropzone.fetch');

Route::get('dropzone/delete', [App\Http\Controllers\GalleryController::class,'delete'])->name('dropzone.delete');
Route::get('/admin/menuapp',[App\Http\Controllers\MenuController::class,'menuapp']);
Route::resource('/admin/bdirector',BDController::class);
Route::resource('/admin/usermenu',UserMenuController::class);
Route::resource('/admin/client',ClientController::class);
Route::get('admin/client/fetch',[App\Http\Controllers\ClientController::class,'fetch'])->name('client.fetch');
Route::post('/admin/client/filename',[App\Http\Controllers\ClientController::class,'clientfilename'])->name('client.filename');
Route::resource('admin/carousel', CarouselController::class);
Route::post('/admin/carousel/filename',[App\Http\Controllers\CarouselController::class,'carouselfilename'])->name('carousel.filename');
});
