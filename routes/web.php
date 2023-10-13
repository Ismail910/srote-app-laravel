<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController ;


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



Route::get('/', [HomeController::class , 'index'])->name('home');

Route::get('/product', [ProductController::class , 'index'])->name('product.index');
Route::get('/product/{product:slug}', [ProductController::class , 'show'])->name('product.details');


Route::get('/login/google', [DashboardController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [DashboardController::class, 'handleGoogleCallback']);


require __DIR__ . '/auth.php';

require __DIR__. '/dashboard.php';
