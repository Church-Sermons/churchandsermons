<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Resource extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['name', 'description', 'filename'];

    public function category()
    {
        return $this->hasOne('App\OrganisationCategory', 'id', 'category_id');
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('video');
        $this->addMediaCollection('audio');
        $this->addMediaCollection('document');
    }
}
