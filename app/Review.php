<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['rating', 'message'];

    public function organisation()
    {
        return $this->belongsTo('App\Organisation', 'uuid_link', 'uuid');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
