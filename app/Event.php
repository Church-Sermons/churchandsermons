<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;
use Spatie\MediaLibrary\Models\Media;

class Event extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'events';

    protected $guarded = ['uuid_link'];

    public function organisation()
    {
        return $this->belongsTo('App\Organisation', 'uuid_link', 'uuid');
    }

    public function registerMediaCollections()
    {
        // register image media
        $this->addMediaCollection('poster')
            ->acceptsFile(function (File $file) {
                return $file->mimeType == 'image/jpeg' ||
                    $file->mimeType == 'image/png' ||
                    $file->mimeType == 'image/jpg' ||
                    $file->mimeType == 'image/svg' ||
                    $file->mimeType == 'image/gif';
            })
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->height(100)
                    ->width(100);

                $this->addMediaConversion('main')
                    ->height(300)
                    ->width(300);
            });
    }
}
