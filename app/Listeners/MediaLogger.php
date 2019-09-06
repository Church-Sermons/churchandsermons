<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\MediaLibrary\Events\MediaHasBeenAdded;
use Log;
use Storage;

class MediaLogger
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
    public function handle(MediaHasBeenAdded $event)
    {
        $media = $event->media;
        $path = $media->getPath();
        Log::info("file {$path} has been saved for media {$media->id}");
        Storage::makeDirectory('overkill');
    }
}
