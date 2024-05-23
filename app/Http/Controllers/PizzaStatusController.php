<?php

namespace App\Http\Controllers;

use App\PizzaStatus;
use App\Models\Pizza;
use App\Events\PizzaStatusUpdated;
use App\Http\Requests\UpdatePizzaStatusRequest;

class PizzaStatusController extends Controller
{
    public function update(UpdatePizzaStatusRequest $request, Pizza $pizza)
    {
        match ($request->input('status')) {
            PizzaStatus::STARTED => $this->start($pizza),
            PizzaStatus::IN_OVEN => $this->inOven($pizza),
            PizzaStatus::READY => $this->ready($pizza),
            PizzaStatus::DELIVERED => $this->delivered($pizza),
        };

        event(new PizzaStatusUpdated($pizza));

        return response()->json([
            'message' => 'Pizza status updated'
        ]);
    }

    private function start(Pizza $pizza)
    {
        $pizza->started_at = now();
        $pizza->save();
    }

    private function inOven(Pizza $pizza)
    {
        $pizza->in_oven_at = now();
        $pizza->save();
    }

    private function ready(Pizza $pizza)
    {
        $pizza->ready_at = now();
        $pizza->save();
    }

    private function delivered(Pizza $pizza)
    {
        $pizza->delivered_at = now();
        $pizza->save();
    }
}
