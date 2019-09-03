<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $fillable = ['message', 'subject'];

    public function organisation()
    {
        return $this->belongsTo('App\Organisation', 'uuid_link', 'uuid');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'sender_id');
    }
}
