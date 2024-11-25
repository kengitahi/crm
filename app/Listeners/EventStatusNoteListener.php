<?php

namespace App\Listeners;

use App\Events\EventStatusNoteEvent;
use App\Models\User;
use App\Notifications\EventStatusNote;
use Illuminate\Support\Facades\Notification;

class EventStatusNoteListener
{
    /**
     * Handle the event.
     */
    public function handle(EventStatusNoteEvent $event)
    {
        $host = User::find($event->event->host);

        Notification::send($event->notifyUser, new EventStatusNote($event->event));

        if ($host) {
            Notification::send($host, new EventStatusNote($event->event));
        }
    }
}
