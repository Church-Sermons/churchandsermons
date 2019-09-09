<?php

namespace App\Observers;

use App\Event;
use App\Helpers\Handler;
use Storage;

class EventObserver
{
    /**
     * Handle the event "created" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public function created(Event $event)
    {
        //
    }

    /**
     * Handle the event "creating" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public function creating(Event $event)
    {
        // check if image is empty
        if (empty(request()->poster)) {
            // add own path
            $event->poster = 'images/default-logo.png';
        }
    }

    /**
     * Handle the event "updated" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public function updated(Event $event)
    {
        //
    }

    /**
     * Handle the event "updating" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public function updating(Event $event)
    {
        Handler::model($event)
            ->whileUpdating('poster')
            ->deleteImage();
    }

    /**
     * Handle the "deleting" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public function deleting(Event $event)
    {
        Handler::model($event)
            ->whileDeleting('poster')
            ->deleteImage();
    }

    /**
     * Handle the event "deleted" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public function deleted(Event $event)
    {
        //
    }

    /**
     * Handle the event "restored" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public function restored(Event $event)
    {
        //
    }

    /**
     * Handle the event "force deleted" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public function forceDeleted(Event $event)
    {
        //
    }
}
