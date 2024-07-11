<?php

namespace App\Models;

use App\PizzaStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function status(): string
    {
        if ($this->delivered_at) {
            return PizzaStatus::DELIVERED->getLabel();
        }

        if ($this->ready_at) {
            return PizzaStatus::READY->getLabel();
        }

        if ($this->in_oven_at) {
            return PizzaStatus::IN_OVEN->getLabel();
        }

        if ($this->started_at) {
            return PizzaStatus::STARTED->getLabel();
        }

        return PizzaStatus::PENDING->getLabel();
    }

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
