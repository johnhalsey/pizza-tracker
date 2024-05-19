<?php

namespace Database\Factories;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pizza>
 */
class PizzaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id'      => function () {
                return \App\Models\Order::factory()->create()->id;
            },
            'type'          => $this->faker->randomElement(['pepperoni', 'hawaiian', 'veggie']),
            'size'          => $this->faker->randomElement(['small', 'medium', 'large']),
            'started_at'    => null,
            'in_oven_at'    => null,
            'ready_at'      => null,
            'delivered_at'  => null,
        ];
    }
}
