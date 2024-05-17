<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    const PENDING = 'Pending';
    const STARTED = 'Started';
    const IN_OVEN = 'In the oven';
    const READY = 'Ready';
    const DELIVERED = 'Delivered';

    public function status()
    {
        if ($this->ready_at) {
            return self::READY;
        }

        if ($this->in_oven_at) {
            return self::IN_OVEN;
        }

        if ($this->started_at) {
            return self::STARTED;
        }

        return self::PENDING;
    }

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
