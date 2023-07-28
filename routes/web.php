<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
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


Route::get('/', [App\Http\Controllers\PagesController::class, 'index'])->name('pages.index');
Route::get('/about', [App\Http\Controllers\PagesController::class, 'about'])->name('about');
Route::get('/services', [App\Http\Controllers\PagesController::class, 'services'])->name('services');
Route::get('/teams', [App\Http\Controllers\PagesController::class, 'teams'])->name('teams');
Route::get('/contact', [App\Http\Controllers\PagesController::class, 'contact'])->name('contact');
Route::get('/branch', [App\Http\Controllers\PagesController::class, 'branch'])->name('branch');
Route::get('/blog', [App\Http\Controllers\PagesController::class, 'blog'])->name('blog');
Route::get('/blog-details/{id}', [App\Http\Controllers\PagesController::class, 'blogid'])->name('blog-select');
Route::get('/warehouse-management', [App\Http\Controllers\PagesController::class, 'warehouse']);
Route::get('/transport-services', [App\Http\Controllers\PagesController::class, 'transport']);
Route::get('/other-services', [App\Http\Controllers\PagesController::class, 'other']);
Route::resource('/comment',CommentController::class);


Auth::routes();




Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/activity', [App\Http\Controllers\AdminController::class, 'activity'])->name('admin.activity');
Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::resource('/admin/user',UserController::class);
Route::resource('/admin/apps',ApplicationController::class);
Route::resource('/admin/menu',MenuController::class);
Route::resource('/admin/setting',SettingController::class);
Route::resource('/admin/gallery',GalleryController::class);
Route::resource('/admin/post',PostController::class);
Route::resource('/admin/categorie', CategorieController::class);
//Route::get('/admin/gallery/{id}/image', [App\Http\Controllers\GalleryController::class, 'viewimage'])->name('admin.gallery.image');
Route::post('/admin/gallery/image/{id}', [App\Http\Controllers\GalleryController::class, 'addimage']);
Route::resource('/admin/branch', BranchController::class);
Route::get('/file-resize', [App\Http\Controllers\ResizeController::class, 'index']);
Route::post('/resize-file', [App\Http\Controllers\ResizeController::class, 'resizeImage'])->name('resizeImage');

Route::get('/admin/gallery/{id}/image', [App\Http\Controllers\GalleryController::class, 'viewimage']);

Route::post('dropzone/upload', [App\Http\Controllers\DropzoneController::class,'upload'])->name('dropzone.upload');

Route::get('dropzone/fetch', [App\Http\Controllers\DropzoneController::class,'fetch'])->name('dropzone.fetch');

Route::get('dropzone/delete', [App\Http\Controllers\DropzoneController::class,'delete'])->name('dropzone.delete');
