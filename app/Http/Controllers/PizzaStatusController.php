<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;

class PizzaStatusController extends Controller
{
    public function start(Request $request, Pizza $pizza)
    {
        $pizza->started_at = now();
        $pizza->save();

        // send http request to website

        return response()->json([
            'message' => 'Pizza started'
        ]);
    }

    public function inOven(Request $request, Pizza $pizza)
    {
        $pizza->in_oven_at = now();
        $pizza->save();

        // send http request to website

        return response()->json([
            'message' => 'Pizza in oven'
        ]);
    }

    public function ready(Request $request, Pizza $pizza)
    {
        $pizza->ready_at = now();
        $pizza->save();

        // send http request to website

        return response()->json([
            'message' => 'Pizza ready'
        ]);
    }

    public function delivered(Request $request, Pizza $pizza)
    {
        $pizza->delivered_at = now();
        $pizza->save();

        // send http request to website

        return response()->json([
            'message' => 'Pizza delivered'
        ]);
    }
}
