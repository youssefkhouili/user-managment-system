<?php

namespace App\Listeners\Users\Logs;

use App\Events\Users\DeletingUser;
use App\UserLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogDeletingUser
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
     * @param  DeletingUser  $event
     * @return void
     */
    public function handle(DeletingUser $event)
    {
        UserLog::create([
            'user_id'   => $event->user->id,
            'slug'      => 'Deleted User',
            'message'   => "Delete {$event->user->name} by " . ($event->deleted_by->name ?? 'Not Found') . " At ($event->deleted_at)"
        ]);

        return true;
    }
}
