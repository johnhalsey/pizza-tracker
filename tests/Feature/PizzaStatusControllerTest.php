<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pizza;
use App\Enums\PizzaStatus;
use App\Events\PizzaStatusUpdated;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PizzaStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_update_pizza_to_started()
    {
        $pizza = Pizza::factory()->create();

        Event::fake();

        $response = $this->putJson('/api/pizzas/' . $pizza->id . '/status', [
            'status' => 'started'
        ])
            ->assertStatus(200);

        Event::assertDispatched(PizzaStatusUpdated::class);

        $this->assertEquals(PizzaStatus::STARTED, $pizza->fresh()->status());
    }

    /** @test */
    public function user_can_update_pizza_to_in_oven()
    {
        $pizza = Pizza::factory()->create();

        Event::fake();

        $response = $this->putJson('/api/pizzas/' . $pizza->id . '/status', [
            'status' => 'in_oven'
        ])
            ->assertStatus(200);

        Event::assertDispatched(PizzaStatusUpdated::class);

        $this->assertEquals(PizzaStatus::IN_OVEN, $pizza->fresh()->status());
    }

    /** @test */
    public function user_can_update_pizza_to_ready()
    {
        $pizza = Pizza::factory()->create();

        Event::fake();

        $response = $this->putJson('/api/pizzas/' . $pizza->id . '/status', [
            'status' => 'ready'
        ])
            ->assertStatus(200);

        Event::assertDispatched(PizzaStatusUpdated::class);

        $this->assertEquals(PizzaStatus::READY, $pizza->fresh()->status());
    }

    /** @test */
    public function user_can_update_pizza_to_delivered()
    {
        $pizza = Pizza::factory()->create();

        Event::fake();

        $response = $this->putJson('/api/pizzas/' . $pizza->id . '/status', [
            'status' => 'delivered'
        ])
            ->assertStatus(200);

        Event::assertDispatched(PizzaStatusUpdated::class);

        $this->assertEquals(PizzaStatus::DELIVERED, $pizza->fresh()->status());
    }



}
