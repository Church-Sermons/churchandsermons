<?php

namespace App;

use App\Traits\CustomMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Profile extends Model implements HasMedia
{
    use HasMediaTrait, CustomMediaTrait;

    protected $guarded = ["category_id", "user_id"];

    public function category()
    {
        return $this->hasOne('App\OrganisationCategory', 'id', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function claims()
    {
        return $this->hasMany('App\Claim', 'uuid_link', 'uuid')->orderBy(
            'id',
            'desc'
        );
    }

    public function reviews()
    {
        return $this->hasMany('App\Review', 'uuid_link', 'uuid')->orderBy(
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

    public function organisations()
    {
        return $this->belongsToMany(
            'App\Organisation',
            'profile_links',
            'profile_id',
            'uuid_link',
            'id',
            'uuid'
        );
    }

    public function events()
    {
        return $this->hasMany('App\Event', 'uuid_link', 'uuid')->orderBy(
            'id',
            'desc'
        );
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

    public function schedules()
    {
        return $this->hasMany(
            'App\WorkingSchedule',
            'uuid_link',
            'uuid'
        )->orderBy('day_of_week', 'asc');
    }

    public function social()
    {
        return $this->hasMany('App\SocialLink', 'uuid_link', 'uuid')->orderBy(
            'id',
            'desc'
        );
    }

    // scopes
    public function scopeGetByUuid($query, $uuid)
    {
        return $query->where('uuid', $uuid)->first();
    }

    public function scopeLoadWithRelations($query, $uuid)
    {
        return $query
            ->where('uuid', $uuid)
            ->with(['category'])
            ->first();
    }

    // Laravel Media Library
    // media collections
    public function registerMediaCollections()
    {
        $this->sharedMediaCollections('profile_image');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->sharedMediaConversions('profile_image');
    }
}
