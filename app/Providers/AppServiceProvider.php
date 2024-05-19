<?php

namespace App\Providers;

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
        $this->when()
            ->needs(\App\Contracts\WebsiteApiInterface::class)
            ->give(\App\Services\WebsiteApi::class);
    }
}
