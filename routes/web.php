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


Route::post('/contact', [ContactController::class, 'sendmessage']);

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('login', [LoginController::class, 'index'])->name('login');;
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('auth/logout', [LoginController::class, 'logout']);

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route::get('/admin', [DashboardController::class, 'index']);

    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::get('user/create', [UserController::class, 'create'])->name('create-user');
    Route::post('user/store', [UserController::class, 'store'])->name('store-user');
    Route::get('user/{user:id}/edit', [UserController::class, 'edit'])->name('edit-user');
    Route::put('user/{user:id}', [UserController::class, 'update'])->name('update-user');
    Route::delete('user/{user:id}', [UserController::class, 'destroy'])->name('destroy-user');

    Route::get('category', [GalleryCategoryController::class, 'index'])->name('category');
    Route::post('category/store', [GalleryCategoryController::class, 'store'])->name('store-category');
    Route::put('category/{gallery_category:id}', [GalleryCategoryController::class, 'update'])->name('update-category');
    Route::delete('category/{gallery_category:id}', [GalleryCategoryController::class, 'destroy'])->name('destroy-category');

    Route::get('gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::get('gallery/create', [GalleryController::class, 'create'])->name('create-gallery');
    Route::post('gallery/store', [GalleryController::class, 'store'])->name('store-gallery');
    Route::get('gallery/{gallery:id}/edit', [GalleryController::class, 'edit'])->name('edit-gallery');
    Route::put('gallery/{gallery:id}', [GalleryController::class, 'update'])->name('update-gallery');
    Route::delete('gallery/{gallery:id}', [GalleryController::class, 'destroy'])->name('destroy-gallery');
});

// API
Route::get('/api/gallerycategory/{gallery_category:id}', [GalleryCategoryController::class, 'api_gallerycategory']);