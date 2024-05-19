<?php

namespace Tests\Unit\Events;

use Tests\TestCase;
use App\Models\Pizza;
use Illuminate\Support\Str;
use App\Events\PizzaStatusUpdated;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PizzaStatusUpdatedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function http_request_sent_when_event_triggered()
    {
        $pizza = Pizza::factory()->create(['started_at' => now()]);
        Http::fake();

        event(new PizzaStatusUpdated($pizza));

        Http::assertSent(function ($request) use ($pizza) {
            return $request->url() === 'https://myperfectpizza.com/api/order/' . $pizza->order_id . '/pizza/' . $pizza->id . '/status/' . Str::lower($pizza->status());
        });
    }
}
