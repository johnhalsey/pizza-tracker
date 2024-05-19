<?php

namespace Tests\Unit;

use App\Models\Pizza;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PizzaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pizza_status_is_pending()
    {
        $pizza = Pizza::factory()->create();

        $this->assertEquals(Pizza::PENDING, $pizza->status());
    }

    /** @test */
    public function pizza_status_is_started()
    {
        $pizza = Pizza::factory()->create(['started_at' => now()]);

        $this->assertEquals(Pizza::STARTED, $pizza->status());
    }

    /** @test */
    public function pizza_status_is_in_oven()
    {
        $pizza = Pizza::factory()->create(['in_oven_at' => now()]);

        $this->assertEquals(Pizza::IN_OVEN, $pizza->status());
    }

    /** @test */
    public function pizza_status_is_ready()
    {
        $pizza = Pizza::factory()->create(['ready_at' => now()]);

        $this->assertEquals(Pizza::READY, $pizza->status());
    }

    /** @test */
    public function pizza_status_is_delivered()
    {
        $pizza = Pizza::factory()->create(['delivered_at' => now()]);

        $this->assertEquals(Pizza::DELIVERED, $pizza->status());
    }
}
