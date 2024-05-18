<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PizzaStatusController;

Route::get('/', function () {
    return view('orders');
});

// endpoint for us to list the orders
Route::get('api/orders', [OrderController::class, 'index'])->name('orders.index');
// endpoint for the POS to hit when new orders created
Route::post('api/orders', [OrderController::class, 'store'])->name('orders.store');

// endpoints for us to hit when order status change
Route::post('api/pizzas/{pizza}/started', [PizzaStatusController::class, 'start'])->name('orders.start');
Route::post('api/pizzas/{pizza}/in-oven', [PizzaStatusController::class, 'inOven'])->name('orders.inOven');
Route::post('api/pizzas/{pizza}/ready', [PizzaStatusController::class, 'ready'])->name('orders.ready');
Route::post('api/pizzas/{pizza}/delivered', [PizzaStatusController::class, 'delivered'])->name('orders.delivered');
