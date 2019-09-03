<?php

namespace App\Observers;

use App\Event;
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
        // Deleting file on update
        if (empty(request()->poster)) {
            // empty request use already existing file in db
            $event->poster = $event->getOriginal('poster');
        } else {
            // get old poster
            $oldPoster = $event->poster;

            // save new poster
            $event->poster = request()->poster->store('uploads', 'public');

            if (is_file(public_path('storage/' . $oldPoster))) {
                // delete old poster
                Storage::disk('public')->delete($oldPoster);
            }
        }
    }

    /**
     * Handle the event "deleting" event.
     *
     * @param  \App\Event  $event
     * @return void
     */
    public function deleting(Event $event)
    {
        // get poster
        $poster = $event->poster;

        if (is_file(public_path('storage/' . $poster))) {
            // delete old poster
            Storage::disk('public')->delete($poster);
        }
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
