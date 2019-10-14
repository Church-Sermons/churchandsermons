<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\GetAudioResourceAttributes;
use Illuminate\Support\Facades\Log;
use App\Helpers\Helper;

class ResourceUploadSuccessfullListener implements ShouldQueue
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
        Log::channel('custom')->info('ResourceUploadSuccessfullListener class');

        $media = $event->media;
        $type = $media->collection_name;

        if ($type == 'audio') {
            // get audio attributes
            $title = Helper::media($media->getFullUrl())->getTitle();
            $artist = Helper::media($media->getFullUrl())->getArtist();
            $duration = Helper::media($media->getFullUrl())->getDuration();

            // store in db slowly
            if ($title || $artist || $duration) {
                // prepare
                $data = [
                    'title' => $title,
                    'artist' => $artist,
                    'duration' => $duration
                ];

                Log::channel('custom')->info(
                    "Title: {$title} Artist: {$artist} Duration: {$duration}"
                );

                // might come in handy later
                $data = json_encode($data);

                $media->setCustomProperty('title', $title);
                $media->setCustomProperty('artist', $artist);
                $media->setCustomProperty('duration', $duration);
                $media->save();

                Log::channel('custom')->info('Listener Job Completed');
            }
        }

        // dispatch(new GetAudioResourceAttributes($event->media));
    }
}
