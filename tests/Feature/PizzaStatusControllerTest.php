<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pizza;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PizzaStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_update_pizza_to_started()
    {
        $pizza = Pizza::factory()->create();

        $response = $this->putJson('/api/pizzas/' . $pizza->id . '/started')
            ->assertStatus(200);

        $this->assertEquals(Pizza::STARTED, $pizza->fresh()->status());
    }

    /** @test */
    public function user_can_update_pizza_to_in_oven()
    {
        $pizza = Pizza::factory()->create();

        $response = $this->putJson('/api/pizzas/' . $pizza->id . '/in-oven')
            ->assertStatus(200);

        $this->assertEquals(Pizza::IN_OVEN, $pizza->fresh()->status());
    }

    /** @test */
    public function user_can_update_pizza_to_ready()
    {
        $pizza = Pizza::factory()->create();

        $response = $this->putJson('/api/pizzas/' . $pizza->id . '/ready')
            ->assertStatus(200);

        $this->assertEquals(Pizza::READY, $pizza->fresh()->status());
    }

    /** @test */
    public function user_can_update_pizza_to_delivered()
    {
        $pizza = Pizza::factory()->create();

        $response = $this->putJson('/api/pizzas/' . $pizza->id . '/delivered')
            ->assertStatus(200);

        $this->assertEquals(Pizza::DELIVERED, $pizza->fresh()->status());
    }



}
