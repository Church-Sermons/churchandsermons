<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;
use Spatie\MediaLibrary\Models\Media;

class OrganisationCategory extends Model implements HasMedia
{
    // HasMediaTrait
    use HasMediaTrait;

    // timestamps
    public $timestamps = false;

    protected $fillable = ['name', 'linked_to', 'image', 'image_url'];

    public function scopeDistinctCategoryNames($query)
    {
        return $query->get()->unique('name');
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('uploads')
            ->singleFile()
            ->acceptsFile(function (File $file) {
                return $file->mimeType == 'image/jpeg' ||
                    $file->mimeType == 'image/png' ||
                    $file->mimeType == 'image/jpg' ||
                    $file->mimeType == 'image/svg' ||
                    $file->mimeType == 'image/gif';
            });

        $this->addMediaCollection('downloads')
            ->singleFile()
            ->acceptsFile(function (File $file) {
                return $file->mimeType == 'image/jpeg' ||
                    $file->mimeType == 'image/png' ||
                    $file->mimeType == 'image/jpg' ||
                    $file->mimeType == 'image/svg' ||
                    $file->mimeType == 'image/gif';
            });
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->height(100)
            ->width(100)
            ->performOnCollections('downloads', 'uploads');

        $this->addMediaConversion('main')
            ->height(300)
            ->width(300)
            ->performOnCollections('downloads', 'uploads');
    }
}
