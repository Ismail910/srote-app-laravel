<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoresController;
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


Route::get('/login/google',[DashboardController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [DashboardController::class ,'handleGoogleCallback']);


Route::get('/',[DashboardController::class ,'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/categories/trash', [CategoriesController::class, 'trash'])->name('categories.trash');
Route::put('/categories/{category}/restore', [CategoriesController::class, 'restore'])->name('categories.restore');
Route::delete('/categories/{category}/force-delete', [CategoriesController::class, 'force_delete'])->name('categories.force-delete');
 
Route::resource('categories',CategoriesController::class)->middleware("auth");
Route::resource('products',ProductController::class)->middleware("auth");
Route::resource('store',StoresController::class)->middleware("auth");
require __DIR__.'/auth.php';

