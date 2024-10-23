<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('brands', BrandController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
});

Route::controller(FrontController::class)->prefix('frontend')->group(function () {
    Route::get('buildmenu', 'buildMenu');
    Route::get('/home', 'home');
    Route::get('/products', 'products');
    Route::get('/productAssessories', 'productAssessories');
    Route::get('/product/{product}', 'product');
    Route::get('/product', 'static');
});


require __DIR__.'/auth.php';
