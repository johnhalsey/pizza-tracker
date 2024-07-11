<?php

namespace App\Enums;

enum OrderStatus: string
{
    case BUILDING = 'building';
    case PENDING = 'pending';
    case STARTED = 'started';
    case BAKING = 'baking';
    case READY = 'ready';
    case COMPLETE = 'complete';

    public function getLabel(): string
    {
        return match ($this) {
            OrderStatus::BUILDING => 'Building',
            OrderStatus::PENDING => 'Pending',
            OrderStatus::STARTED => 'Started',
            OrderStatus::BAKING => 'Baking',
            OrderStatus::READY => 'Ready',
            OrderStatus::COMPLETE => 'Completed',
        };
    }
}
