<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdminProductsController;
use App\Http\Controllers\UserProductsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', [AdminProductsController::class, 'index']);
Route::get('/products/{id}', [AdminProductsController::class, 'show']);
Route::post('/cart/add', [UserProductsController::class, 'addToCart']);
Route::get('/cart/view', [UserProductsController::class, 'viewCart']);
Route::put('/cart/update', [UserProductsController::class, 'updateCart']);
Route::delete('/cart/delete', [UserProductsController::class, 'clearCart']);
Route::delete('/cart/delete-item', [UserProductsController::class, 'removeProductFromCart']);

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
->middleware('guest')
->name('login');

Route::post('/register', [RegisteredUserController::class, 'store'])
->middleware('guest')
->name('register');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:sanctum')
    ->name('logout');

Route::middleware(['auth:sanctum', 'user'])->group(function () {
    Route::post('/cart/purchase', [UserProductsController::class, 'purchase']);
});


Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/products', [AdminProductsController::class, 'index']);
    Route::get('/admin/products/{id}', [AdminProductsController::class, 'show']);
    Route::post('/admin/products/create', [AdminProductsController::class, 'store']);
    Route::put('/admin/products/update/{id}', [AdminProductsController::class, 'update']);
    Route::delete('/admin/products/delete/{id}', [AdminProductsController::class, 'destroy']);
});
