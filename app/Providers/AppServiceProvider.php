<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(\App\Contracts\WebsiteApiInterface::class, \App\Services\WebsiteApi::class);

        Event::listen(
            PizzaStatusUpdated::class,
            SendPizzaStatusUpdate::class,
        );
    }
}
