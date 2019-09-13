<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = ['share_link', 'page_link', 'social_id'];

    public function social()
    {
        return $this->belongsTo('App\SocialMedia', 'social_id');
    }
}
