<?php

namespace App\Models;

use App\Enums\PizzaStatus;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_number'];

    public function status(): OrderStatus
    {
        if ($this->pizzas->isEmpty()) {
            return OrderStatus::BUILDING;
        }

        // If all pizzas are delivered, the order is complete
        if ($this->pizzas->every(fn($pizza) => $pizza->status() === PizzaStatus::DELIVERED)) {
            return OrderStatus::COMPLETE;
        }

        // if all pizzas are ready OR delivered, the order is ready
        if ($this->pizzas->every(fn($pizza) => $pizza->status() === PizzaStatus::READY || $pizza->status() === PizzaStatus::DELIVERED)) {
            return OrderStatus::READY;
        }

        // if any pizza is in the oven, the order is baking
        if ($this->pizzas->contains(fn($pizza) => $pizza->status() === PizzaStatus::IN_OVEN)) {
            return OrderStatus::BAKING;
        }

        // if any pizza is in the oven OR Ready, the order is baking
        if ($this->pizzas->contains(fn($pizza) => $pizza->status() === PizzaStatus::IN_OVEN || $pizza->status() === PizzaStatus::READY)) {
            return OrderStatus::BAKING;
        }

        // if any pizza is started, the order is started
        if ($this->pizzas->contains(fn($pizza) => $pizza->status() === PizzaStatus::STARTED)) {
            return OrderStatus::STARTED;
        }

        // just in case an order comes in with no pizzas
        return OrderStatus::PENDING;
    }

    public function pizzas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Pizza::class);
    }
}
