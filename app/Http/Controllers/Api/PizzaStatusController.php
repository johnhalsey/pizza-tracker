<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Pizza;
use Illuminate\Http\JsonResponse;
use App\Events\PizzaStatusUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePizzaStatusRequest;

class PizzaStatusController extends Controller
{
    public function update(UpdatePizzaStatusRequest $request, Pizza $pizza): JsonResponse
    {
        $pizza->update([
            $request->input('status') . '_at' => Carbon::now()
        ]);

        PizzaStatusUpdated::dispatch($pizza);

        return response()->json([
            'message' => 'Pizza status updated'
        ]);
    }
}
