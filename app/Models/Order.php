<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const BUILDING = 'Building';
    const PENDING = 'Pending';
    const STARTED = 'Started';
    const READY = 'Ready';
    const COMPLETE = 'Complete';

    public function status()
    {
        // If all pizzas are delivered, the order is complete
        if ($this->pizzas->every(fn($pizza) => $pizza->status() === Pizza::DELIVERED)) {
            return self::COMPLETE;
        }

        // if all pizzas are ready OR delivered, the order is ready
        if ($this->pizzas->every(fn($pizza) => $pizza->status() === Pizza::READY || $pizza->status() === Pizza::DELIVERED)) {
            return self::READY;
        }

        // if any pizza is in the oven, the order is started
        if ($this->pizzas->contains(fn($pizza) => $pizza->status() === Pizza::IN_OVEN)) {
            return self::STARTED;
        }

        // if any pizza is started, the order is started
        if ($this->pizzas->contains(fn($pizza) => $pizza->status() === Pizza::STARTED)) {
            return self::STARTED;
        }

        // if any pizza exists, the order is pending
        if ($this->pizzas->isNotEmpty()) {
            return self::PENDING;
        }

        // just in case an order comes in with no pizzas
        return self::BUILDING;
    }

    public function pizzas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Pizza::class);
    }
}
