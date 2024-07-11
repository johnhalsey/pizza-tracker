<?php

namespace App\Models;

use App\Enums\PizzaStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pizza extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function status(): PizzaStatus
    {
        if ($this->delivered_at) {
            return PizzaStatus::DELIVERED;
        }

        if ($this->ready_at) {
            return PizzaStatus::READY;
        }

        if ($this->in_oven_at) {
            return PizzaStatus::IN_OVEN;
        }

        if ($this->started_at) {
            return PizzaStatus::STARTED;
        }

        return PizzaStatus::PENDING;
    }

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
