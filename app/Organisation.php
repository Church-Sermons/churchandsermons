<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\File;
use Spatie\MediaLibrary\Models\Media;

class Organisation extends Model implements HasMedia
{
    use HasMediaTrait;

    // guarded
    protected $guarded = ['category_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->hasOne('App\OrganisationCategory', 'id', 'category_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review', 'uuid_link', 'uuid')->orderBy(
            'id',
            'desc'
        );
    }

    public function claims()
    {
        return $this->hasMany('App\Claim', 'uuid_link', 'uuid')->orderBy(
            'id',
            'desc'
        );
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact', 'uuid_link', 'uuid')->orderBy(
            'id',
            'desc'
        );
    }

    public function events()
    {
        return $this->hasMany('App\Event', 'uuid_link', 'uuid')->orderBy(
            'id',
            'desc'
        );
    }

    public function profiles()
    {
        return $this->belongsToMany(
            'App\Profile',
            'profile_links',
            'uuid_link',
            'profile_id',
            'uuid'
        )->orderBy('id', 'desc');
    }

    public function resources()
    {
        return $this->belongsToMany(
            'App\Resource',
            'resource_links',
            'uuid_link',
            'resource_id',
            'uuid'
        )->orderBy('id', 'desc');
    }

    // media collections
    public function registerMediaCollections()
    {
        // logo collection
        $this->addMediaCollection('logo')
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
    }

    public function registerMediaConversions(Media $media = null)
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
            ->performOnCollections('logo');
    }
}
