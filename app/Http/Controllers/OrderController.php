<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Http\Requests\StorePizzaOrderRequest;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('pizzas')->get();

        return OrderResource::collection($orders);
    }

    public function store(StorePizzaOrderRequest $request)
    {
        $order = Order::create([
            'order_number' => $request->input('order_number'),
        ]);

        foreach ($request->input('pizza') as $pizza) {
            $order->pizzas()->create([
                'type' => $pizza['type'],
                'size' => $pizza['size'],
            ]);
        }

        return response('OK');
    }
}
