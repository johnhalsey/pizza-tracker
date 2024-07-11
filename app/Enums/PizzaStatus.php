<?php

namespace App\Enums;

enum PizzaStatus: string
{
    case PENDING = 'pending';
    case STARTED = 'started';
    case IN_OVEN = 'in_oven';
    case READY = 'ready';
    case DELIVERED = 'delivered';

    public function getLabel(): string
    {
        return match ($this) {
            PizzaStatus::PENDING => 'Pending',
            PizzaStatus::STARTED => 'Started',
            PizzaStatus::IN_OVEN => 'In the oven',
            PizzaStatus::READY => 'Ready',
            PizzaStatus::DELIVERED => 'Delivered',
        };
    }
}
