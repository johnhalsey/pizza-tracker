<?php

namespace App\Events;

use App\Models\Pizza;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class PizzaStatusUpdated
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Pizza $pizza)
    {
        //
    }
}
