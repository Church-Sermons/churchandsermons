<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = ["category_id", "user_id"];

    public function category()
    {
        return $this->hasOne('App\OrganisationCategory', 'id', 'category_id');
    }

    public function claims()
    {
        return $this->hasMany('App\Claim', 'uuid_link', 'uuid')->orderBy(
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

    // scopes
    public function scopeGetByUuid($query, $uuid)
    {
        return $query->where('uuid', $uuid)->first();
    }
}
