<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
Route::put('/categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
Route::delete('/categories/{category}/force-delete', [CategoryController::class, 'force_delete'])->name('categories.force-delete');


Route::get('/products/trash', [ProductController::class, 'trash'])->name('products.trash');
Route::put('/products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');
Route::delete('/products/{product}/force-delete', [ProductController::class, 'force_delete'])->name('products.force-delete');


Route::get('/stores/trash', [StoreController::class, 'trash'])->name('stores.trash');
Route::put('/stores/{store}/restore', [StoreController::class, 'restore'])->name('stores.restore');
Route::delete('/stores/{store}/force-delete', [StoreController::class, 'force_delete'])->name('stores.force-delete');


Route::resource('categories', CategoryController::class)->middleware("auth");
Route::resource('products', ProductController::class)->middleware("auth");
Route::resource('stores', StoreController::class)->middleware("auth");