<?php

namespace App;

use App\Traits\CustomMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Sermon extends Model implements HasMedia
{
    use HasMediaTrait;

    use CustomMediaTrait;

    protected $fillable = ['title', 'description'];

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

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // scopes
    public function scopeGetByUuid($query, $uuid)
    {
        return $query->where('uuid', $uuid)->first();
    }

    // media collections
    public function registerMediaCollections()
    {
        $this->sharedMediaCollections();
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->sharedMediaConversions();
    }
}
