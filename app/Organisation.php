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
            })
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->height(100)
                    ->width(100);

                $this->addMediaConversion('main')
                    ->height(300)
                    ->width(300);
            });

        // resources collection
        $this->addMediaCollection('video');
        $this->addMediaCollection('audio');
        $this->addMediaCollection('document');
        $this->addMediaCollection('assets');
    }
}
