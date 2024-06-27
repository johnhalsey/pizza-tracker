<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Requests\StorePizzaOrderRequest;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('pizzas')->orderBy('created_at', 'desc')->get();

        return OrderResource::collection($orders);
    }

    public function store(StorePizzaOrderRequest $request)
    {
        $order = Order::create([
            'order_number' => $request->input('order_number'),
        ]);

        foreach ($request->input('pizzas') as $pizza) {
            $order->pizzas()->create([
                'type' => $pizza['type'],
                'size' => $pizza['size'],
            ]);
        }

        return response()->json([
            'message' => 'Order created',
        ], 201);
    }
}
