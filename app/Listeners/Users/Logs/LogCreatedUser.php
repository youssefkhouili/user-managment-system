<?php

namespace App\Listeners\Users\Logs;

use App\Events\Users\CreatedUser;
use App\UserLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogCreatedUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CreatedUser  $event
     * @return void
     */
    public function handle(CreatedUser $event)
    {
        UserLog::create([
            'user_id'   => $event->user->id,
            'slug'      => 'Created User',
            'message'   => "Created {$event->user->name} by " . ($event->created_by->name ?? 'Not Found') . " At ($event->created_at)"
        ]);
        return true;
    }
}
