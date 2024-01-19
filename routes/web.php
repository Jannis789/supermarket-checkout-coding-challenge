<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;

Route::get('/', [StoreController::class, 'index'])->name('store');

Route::post('/', [StoreController::class, 'handleRequest'])->name('handleRequest');

Route::post('/flush', [StoreController::class, 'clearCart'])->name('clearCart');

Route::get('/flush', [StoreController::class, 'clearCart'])->name('clearCart');