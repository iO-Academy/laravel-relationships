<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'getAll']);
Route::post('/products', [ProductController::class, 'add']);


Route::get('/reviews', [ReviewController::class, 'getAll']);
Route::post('/reviews', [ReviewController::class, 'add']);

Route::get('/orders', [OrderController::class, 'getAll']);
Route::post('/orders', [OrderController::class, 'add']);