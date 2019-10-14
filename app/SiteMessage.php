<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteMessage extends Model
{
    protected $table = 'site_messages';

    protected $fillable = ['name', 'email', 'subject', 'message'];
}
