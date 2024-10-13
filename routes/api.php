<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\TaxController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::prefix('auth')->middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});
Route::apiResource('products', ProductController::class)->only('index');
Route::middleware('auth:api')->group(function () {
    Route::apiResource('products', ProductController::class)->except('index');
    Route::apiResource('taxes', TaxController::class);
    Route::post('carts/{cart}/add-product', [CartController::class, 'addProduct']);
    Route::get('carts/{cart}/calculate-total', [CartController::class, 'calculateTotal']);
    Route::get('carts/{cart}', [CartController::class, 'show']);
});
