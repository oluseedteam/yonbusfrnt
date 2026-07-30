<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     */
    protected $listen = [
        \App\Events\AppointmentBooked::class => [
            \App\Listeners\SendBookingConfirmation::class,
        ],
        \App\Events\AppointmentConfirmed::class => [
            \App\Listeners\SendConfirmationNotification::class,
        ],
        \App\Events\AppointmentCancelled::class => [
            \App\Listeners\SendCancellationNotification::class,
        ],
        \App\Events\AppointmentCompleted::class => [
            \App\Listeners\LogAppointmentCompleted::class,
        ],
    ];

    public function boot(): void {}

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
