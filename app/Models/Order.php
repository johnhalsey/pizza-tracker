<?php

namespace App\Models;

use App\PizzaStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const BUILDING = 'Building';
    const PENDING = 'Pending';
    const STARTED = 'Started';
    const BAKING = 'Baking';
    const READY = 'Ready';
    const COMPLETE = 'Complete';

    protected $fillable = ['order_number'];

    public function status(): string
    {
        if ($this->pizzas->isEmpty()) {
            return self::BUILDING;
        }

        // If all pizzas are delivered, the order is complete
        if ($this->pizzas->every(fn($pizza) => $pizza->status() === PizzaStatus::DELIVERED)) {
            return self::COMPLETE;
        }

        // if all pizzas are ready OR delivered, the order is ready
        if ($this->pizzas->every(fn($pizza) => $pizza->status() === PizzaStatus::READY || $pizza->status() === PizzaStatus::DELIVERED)) {
            return self::READY;
        }

        // if any pizza is in the oven, the order is baking
        if ($this->pizzas->contains(fn($pizza) => $pizza->status() === PizzaStatus::IN_OVEN)) {
            return self::BAKING;
        }

        // if any pizza is in the oven OR Ready, the order is baking
        if ($this->pizzas->contains(fn($pizza) => $pizza->status() === PizzaStatus::IN_OVEN || $pizza->status() === PizzaStatus::READY)) {
            return self::BAKING;
        }

        // if any pizza is started, the order is started
        if ($this->pizzas->contains(fn($pizza) => $pizza->status() === PizzaStatus::STARTED)) {
            return self::STARTED;
        }

        // just in case an order comes in with no pizzas
        return self::PENDING;
    }

    public function pizzas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Pizza::class);
    }
}
