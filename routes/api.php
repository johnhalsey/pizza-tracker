<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PizzaStatusController;

// endpoint for us to list the orders
Route::get('api/orders', [OrderController::class, 'index'])->name('orders.index');
// endpoint for the POS to hit when new orders created
Route::post('api/orders', [OrderController::class, 'store'])->name('orders.store');

// endpoints for us to hit when order status change
Route::put('api/pizzas/{pizza}/status', [PizzaStatusController::class, 'update'])->name('pizza.update');
