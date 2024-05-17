<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('orders');
});

// endpoint for us to list the orders
Route::get('api/orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
// endpoint for the POS to hit when new orders created
Route::post('api/orders', [\App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');

// endpoints for us to hit when order status change
Route::post('api/orders/{order}/start', [OrderStatusController::class, 'start'])->name('orders.start');
Route::post('api/orders/{order}/in-oven', [OrderStatusController::class, 'inOven'])->name('orders.inOven');
Route::post('api/orders/{order}/ready', [OrderStatusController::class, 'ready'])->name('orders.ready');
