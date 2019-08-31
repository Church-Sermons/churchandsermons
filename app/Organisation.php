<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Organisation extends Model implements HasMedia
{
    use HasMediaTrait;

    public function category()
    {
        return $this->hasOne('App\OrganisationCategory', 'id', 'category_id');
    }


    public function reviews()
    {
        return $this->hasMany('App\Review', 'uuid_link', 'uuid')->orderBy('id', 'desc');
    }

    public function events()
    {
        return $this->hasMany('App\Event', 'uuid_link', 'uuid')->orderBy('id', 'desc');
    }

    public function profiles()
    {
        return $this->belongsToMany('App\Profile', 'profile_links', 'uuid_link', 'profile_id', 'uuid')->orderBy('id', 'desc');
    }

    public function resources()
    {
        return $this->belongsToMany('App\Resource', 'resource_links', 'uuid_link', 'resource_id', 'uuid')->orderBy('id', 'desc');
    }
}
