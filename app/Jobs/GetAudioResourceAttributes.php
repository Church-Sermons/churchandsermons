<?php

namespace App\Jobs;

use App\Helpers\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\Models\Media;

class GetAudioResourceAttributes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Media $media)
    {
        $type = $media->collection_name;

        if ($type == 'audio' || $type == 'video') {
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

                // might come in handy later
                $data = json_encode($data);

                $media->setCustomProperty('title', $title);
                $media->setCustomProperty('artist', $artist);
                $media->setCustomProperty('duration', $duration);

                Log::info('GetAudioResourceAttribute Job Completed');
            }
        }
    }
}
