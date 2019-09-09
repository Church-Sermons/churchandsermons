<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\GetAudioResourceAttributes;
use Spatie\MediaLibrary\Events\MediaHasBeenAdded;

class ResourceUploadSuccessfullListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        dispatch(new GetAudioResourceAttributes($event->media));
    }
}
