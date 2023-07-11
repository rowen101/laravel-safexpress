<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MenuController;
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

Auth::routes();



Route::get('/', [App\Http\Controllers\PagesController::class, 'index'])->name('pages.index');
Route::get('/about', [App\Http\Controllers\PagesController::class, 'about'])->name('pages.about');
Route::get('/services', [App\Http\Controllers\PagesController::class, 'services'])->name('pages.services');
Route::get('/teams', [App\Http\Controllers\PagesController::class, 'teams'])->name('pages.teams');
Route::get('/contact', [App\Http\Controllers\PagesController::class, 'contact'])->name('pages.contact');
Route::get('/branch', [App\Http\Controllers\PagesController::class, 'branch'])->name('pages.branch');


Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/activity', [App\Http\Controllers\AdminController::class, 'activity'])->name('admin.activity');
Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::resource('/admin/user',UserController::class);
Route::resource('/admin/apps',ApplicationController::class);
Route::resource('/admin/menu',MenuController::class);
Route::resource('/admin/setting',SettingController::class);
Route::resource('/admin/gallery',GalleryController::class);
//Route::get('/admin/gallery/{id}/image', [App\Http\Controllers\GalleryController::class, 'viewimage'])->name('admin.gallery.image');
Route::post('/admin/gallery/image/{id}', [App\Http\Controllers\GalleryController::class, 'addimage']);

Route::get('/file-resize', [App\Http\Controllers\ResizeController::class, 'index']);
Route::post('/resize-file', [App\Http\Controllers\ResizeController::class, 'resizeImage'])->name('resizeImage');

Route::get('/admin/gallery/{id}/image', [App\Http\Controllers\GalleryController::class, 'viewimage']);

Route::post('dropzone/upload', [App\Http\Controllers\DropzoneController::class,'upload'])->name('dropzone.upload');

Route::get('dropzone/fetch', [App\Http\Controllers\DropzoneController::class,'fetch'])->name('dropzone.fetch');

Route::get('dropzone/delete', [App\Http\Controllers\DropzoneController::class,'delete'])->name('dropzone.delete');
