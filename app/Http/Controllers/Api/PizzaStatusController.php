<?php

namespace App\Http\Controllers\Api;

use App\Models\Pizza;
use App\Events\PizzaStatusUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePizzaStatusRequest;
use function now;
use function event;
use function response;

class PizzaStatusController extends Controller
{
    public function update(UpdatePizzaStatusRequest $request, Pizza $pizza)
    {
        $pizza->update([
            $request->input('status') . '_at' => now()
        ]);

        event(new PizzaStatusUpdated($pizza));

        return response()->json([
            'message' => 'Pizza status updated'
        ]);
    }
}
