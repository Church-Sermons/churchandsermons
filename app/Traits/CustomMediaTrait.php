<?php

namespace App\Traits;

trait CustomMediaTrait
{
    protected function sharedMediaCollections($main = 'logo')
    {
        // logo collection
        $this->addMediaCollection($main)
            ->singleFile()
            ->acceptsFile(function (File $file) {
                return $file->mimeType == 'image/jpeg' ||
                    $file->mimeType == 'image/png' ||
                    $file->mimeType == 'image/jpg' ||
                    $file->mimeType == 'image/svg' ||
                    $file->mimeType == 'image/gif';
            });

        // resources collection
        $this->addMediaCollection('video');
        $this->addMediaCollection('audio');
        $this->addMediaCollection('document');
        $this->addMediaCollection('assets');
        $this->addMediaCollection('slides');
    }

    protected function sharedMediaConversions($main = 'logo')
    {
        $this->addMediaConversion('small')
            ->width(480)
            ->height(320)
            ->extractVideoFrameAtSecond(5)
            ->performOnCollections('video', 'document');

        $this->addMediaConversion('medium')
            ->width(720)
            ->height(480)
            ->extractVideoFrameAtSecond(5)
            ->performOnCollections('video');

        $this->addMediaConversion('large', 'document')
            ->width(1080)
            ->height(720)
            ->extractVideoFrameAtSecond(5)
            ->performOnCollections('video', 'document');

        $this->addMediaConversion('small')
            ->width(300)
            ->height(300)
            ->performOnCollections($main);
    }
}
