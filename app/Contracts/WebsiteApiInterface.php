<?php

namespace App\Contracts;

use App\Models\Pizza;

interface WebsiteApiInterface
{
    /**
     * @param Pizza $pizza
     * @return void
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function sendPizzaStatusUpdate(Pizza $pizza): void;
}
