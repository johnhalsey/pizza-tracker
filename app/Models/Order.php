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

    public function status()
    {
        // if all pizzas are ready, the order is ready
        if ($this->pizzas->every(fn($pizza) => $pizza->status() === Pizza::READY)) {
            return self::READY;
        }

        // if any pizza is started, the order is started
        if ($this->pizzas->contains(fn($pizza) => $pizza->status() === Pizza::STARTED)) {
            return self::STARTED;
        }

        // if any pizza exists, the order is pending
        if ($this->pizzas->isNotEmpty()) {
            return self::PENDING;
        }

        return self::BUILDING;
    }

    public function pizzas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Pizza::class);
    }
}
