<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Pizza;
use App\Enums\PizzaStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PizzaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pizza_status_is_pending()
    {
        $pizza = Pizza::factory()->create();

        $this->assertEquals(PizzaStatus::PENDING, $pizza->status());
    }

    /** @test */
    public function pizza_status_is_started()
    {
        $pizza = Pizza::factory()->create(['started_at' => now()]);

        $this->assertEquals(PizzaStatus::STARTED, $pizza->status());
    }

    /** @test */
    public function pizza_status_is_in_oven()
    {
        $pizza = Pizza::factory()->create(['in_oven_at' => now()]);

        $this->assertEquals(PizzaStatus::IN_OVEN, $pizza->status());
    }

    /** @test */
    public function pizza_status_is_ready()
    {
        $pizza = Pizza::factory()->create(['ready_at' => now()]);

        $this->assertEquals(PizzaStatus::READY, $pizza->status());
    }

    /** @test */
    public function pizza_status_is_delivered()
    {
        $pizza = Pizza::factory()->create(['delivered_at' => now()]);

        $this->assertEquals(PizzaStatus::DELIVERED, $pizza->status());
    }
}
