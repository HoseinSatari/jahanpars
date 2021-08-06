<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\support' => [
            'App\Listeners\sendMail',
        ],
        'App\Events\resetpasswordEmail' => [
            'App\Listeners\resetpasswordEmailListener',
        ],
        'App\Events\resetpasswordSms' => [
            'App\Listeners\resetpasswordSmsListener',
        ],
        'App\Events\CreateOrder' => [
            'App\Listeners\CreateOrderUserSmsListener',
            'App\Listeners\CreateOrderAdminSmsListener',
        ],
        'App\Events\ApprovedOrder' => [
            'App\Listeners\ApprovedOrderUserSmsListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
