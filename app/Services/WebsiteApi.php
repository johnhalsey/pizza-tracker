<?php

namespace App\Services;

use App\Models\Pizza;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Contracts\WebsiteApiInterface;

class WebsiteApi implements WebsiteApiInterface
{
    protected $apiBaseUrl = 'https://myperfectpizza.com/api';
    protected $apiToken = null;

    public function __construct()
    {
        $this->setApiToken();
    }

    private function setApiToken(): void
    {
        $this->apiToken = config('website.api_token');
    }

    public function sendPizzaStatusUpdate(Pizza $pizza): void
    {
        // send Http post request to update the status of the order
        $response = Http::withToken($this->apiToken)
            ->post($this->apiBaseUrl . '/order/' . $pizza->order_id . '/pizza/' . $pizza->id . '/status/' . Str::lower($pizza->status()))
            ->throw();
    }
}
