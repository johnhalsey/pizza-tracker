<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PizzaStatusController;

// endpoint for us to list the orders
Route::get('orders', [OrderController::class, 'index'])->name('api.orders.index');
// endpoint for the POS to hit when new orders created
Route::post('orders', [OrderController::class, 'store'])->name('api.orders.store');
// endpoints for us to hit when order status change
Route::put('pizzas/{pizza}/status', [PizzaStatusController::class, 'update'])->name('api.pizza.update');
