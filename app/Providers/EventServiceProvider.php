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
        'App\Events\Users\CreatedUser'  => [
            'App\Listeners\Users\Logs\LogCreatedUser',
            'App\Listeners\Users\Notifications\NotifyCreatedUser',
        ],
        'App\Events\Users\DeletingUser' => [
            'App\Listeners\Users\Logs\LogDeletingUser',
            'App\Listeners\Users\Notifications\NotifyDeletingUser',
        ]
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
