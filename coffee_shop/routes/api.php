<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\CoffeeFormController;

Route::get('/coffee-form', [CoffeeFormController::class, 'index']);
Route::get('/coffee-form/{id}', [CoffeeFormController::class, 'show']);
Route::post('/coffee-form', [CoffeeFormController::class, 'store']);
Route::put('/coffee-form/{id}', [CoffeeFormController::class, 'update']);
Route::delete('/coffee-form/{id}', [CoffeeFormController::class, 'destroy']);

use App\Http\Controllers\OrderController;

Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
