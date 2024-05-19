<?php

namespace App\Listeners;

use App\Events\PizzaStatusUpdated;
use App\Contracts\WebsiteApiInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPizzaStatusUpdate implements ShouldQueue
{
    use InteractsWithQueue;

    public $tries = 5;

    /**
     * Create the event listener.
     */
    public function __construct(protected WebsiteApiInterface $websiteApi)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PizzaStatusUpdated $event): void
    {
        try{
            $this->websiteApi->sendPizzaStatusUpdate($event->pizza);
        } catch (\Exception $e) {
            // log the error
            logger()->error($e->getMessage());
            // try again after 10 seconds
            $this->release(10);
        }

    }
}
