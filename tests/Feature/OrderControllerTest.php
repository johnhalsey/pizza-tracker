<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pizza;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_get_list_of_orders()
    {
        Pizza::factory(3)->create();

        $response = $this->getJson('/api/orders')
            ->assertStatus(200);

        $json = $response->json()['data'];

        $this->assertCount(3, $json);
    }

    /** @test */
    public function asset_pos_can_push_new_orders()
    {
        $response = $this->postJson('/api/orders', [
            'order_number' => '12345',
            'pizzas' => [
                ['type' => 'pepperoni', 'size' => 'large'],
                ['type' => 'meat feast', 'size' => 'large'],
                ['type' => 'vegetarian', 'size' => 'small'],
            ],
        ])->dump()
            ->assertStatus(201);

        $json = $response->json();

        $this->assertDatabaseCount('orders', 1);
        $this->assertDatabaseCount('pizzas', 3);
    }
}
