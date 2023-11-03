<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\GalleryCategoryController;
use App\Http\Controllers\landingpage\ContactController;

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

Route::get('/', function () {
    return view('home');
});

Route::post('/contact', [ContactController::class, 'sendmessage']);

Route::middleware('guest')->group(function () {
    Route::get('/auth', [LoginController::class, 'index'])->name('login');;
    Route::post('/auth/login', [LoginController::class, 'login']);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/auth/logout', [LoginController::class, 'logout']);
    Route::get('/admin', [DashboardController::class, 'index']);
    
    Route::get('/admin/users', [UserController::class, 'index']);
    Route::get('/admin/user/create', [UserController::class, 'create']);
    Route::post('/admin/user', [UserController::class, 'store']);
    Route::get('/admin/user/{user:id}/edit', [UserController::class, 'edit']);
    Route::put('/admin/user/{user:id}', [UserController::class, 'update']);
    Route::delete('/admin/user/{user:id}', [UserController::class, 'destroy']);
    
    Route::get('/admin/gallerycategories', [GalleryCategoryController::class, 'index']);
    Route::post('/admin/gallerycategory', [GalleryCategoryController::class, 'store']);
    Route::put('/admin/gallerycategory/{gallery_category:id}', [GalleryCategoryController::class, 'update']);
    Route::delete('/admin/gallerycategory/{gallery_category:id}', [GalleryCategoryController::class, 'destroy']);

    Route::get('/admin/galleries', [GalleryController::class, 'index']);
    Route::get('/admin/gallery/create', [GalleryController::class, 'create']);
    Route::post('/admin/gallery', [GalleryController::class, 'store']);
    Route::get('/admin/gallery/{gallery:id}/edit', [GalleryController::class, 'edit']);
    Route::put('/admin/gallery/{gallery:id}', [GalleryController::class, 'update']);
    Route::delete('/admin/gallery/{gallery:id}', [GalleryController::class, 'destroy']);
});

// API
Route::get('/api/gallerycategory/{gallery_category:id}', [GalleryCategoryController::class, 'api_gallerycategory']);