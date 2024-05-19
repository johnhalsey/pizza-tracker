<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Order;
use App\Models\Pizza;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function order_status_is_pending_if_all_pizzas_are_pending()
    {
        $order = Order::factory()->create();
        Pizza::factory()->create(['order_id' => $order->id]);
        Pizza::factory()->create(['order_id' => $order->id]);
        Pizza::factory()->create(['order_id' => $order->id]);

        $this->assertEquals(Order::PENDING, $order->status());
    }

    /** @test */
    public function order_status_is_started_if_at_least_1_pizza_is_started()
    {
        $order = Order::factory()->create();
        Pizza::factory()->create(['order_id' => $order->id, 'started_at' => now()]);
        Pizza::factory()->create(['order_id' => $order->id]);
        Pizza::factory()->create(['order_id' => $order->id]);

        $this->assertEquals(Order::STARTED, $order->status());
    }

    /** @test */
    public function order_status_is_baking_if_at_least_1_pizza_is_in_oven()
    {
        $order = Order::factory()->create();
        Pizza::factory()->create(['order_id' => $order->id, 'started_at' => now()]);
        Pizza::factory()->create(['order_id' => $order->id, 'started_at' => now(), 'in_oven_at' => now()]);
        Pizza::factory()->create(['order_id' => $order->id]);

        $this->assertEquals(Order::BAKING, $order->status());
    }

    /** @test */
    public function order_status_is_ready_if_all_pizzas_are_ready()
    {
        $order = Order::factory()->create();
        Pizza::factory()->create(['order_id' => $order->id, 'started_at' => now(), 'in_oven_at' => now(), 'ready_at' => now()]);
        Pizza::factory()->create(['order_id' => $order->id, 'started_at' => now(), 'in_oven_at' => now(), 'ready_at' => now()]);
        Pizza::factory()->create(['order_id' => $order->id, 'started_at' => now(), 'in_oven_at' => now(), 'ready_at' => now()]);

        $this->assertEquals(Order::READY, $order->status());
    }

    /** @test */
    public function order_status_is_complete_if_all_pizzas_are_delivered()
    {
        $order = Order::factory()->create();
        Pizza::factory()->create(['order_id' => $order->id, 'started_at' => now(), 'in_oven_at' => now(), 'ready_at' => now(), 'delivered_at' => now()]);
        Pizza::factory()->create(['order_id' => $order->id, 'started_at' => now(), 'in_oven_at' => now(), 'ready_at' => now(), 'delivered_at' => now()]);
        Pizza::factory()->create(['order_id' => $order->id, 'started_at' => now(), 'in_oven_at' => now(), 'ready_at' => now(), 'delivered_at' => now()]);

        $this->assertEquals(Order::COMPLETE, $order->status());
    }

    /** @test */
    public function order_status_is_building_if_order_has_no_pizzas()
    {
        $order = Order::factory()->create();

        $this->assertEquals(Order::BUILDING, $order->status());
    }

}
