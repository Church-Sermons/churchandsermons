<?php

namespace App\Jobs;

use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Spatie\MediaLibrary\Models\Media;
use Storage;

class CreateVideoResourceThumbnails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $media;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Media $media)
    {
        $this->media = $media;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Media $media)
    {
        if (explode('/', $media->mime_type)[0] == 'video') {
            // create
            $ffmpeg = FFMpeg::create([
                'ffmpeg.binaries' => env(
                    'FFMPEG_PATH',
                    'C:/binaries/ffmpeg/bin/ffmpeg.exe'
                )
            ]);
            $video = $ffmpeg->open(
                Storage::disk($media->disk)->path(
                    'storage/' . $media->id . '/' . $media->file_name
                )
            );
            // get frames
            $video
                ->frame(TimeCode::fromSeconds(10))
                ->save(
                    Storage::url(
                        "{$media->id}/conversions/{$media->name}-poster"
                    )
                );

            // save
            $media->update([
                'custom_properties' =>
                    '{"generated_conversions":{"poster": true}}'
            ]);
        }
    }
}
