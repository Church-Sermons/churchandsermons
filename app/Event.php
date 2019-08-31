<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $guarded = ['uuid_link'];

    public function organisation()
    {
        return $this->belongsTo('App\Organisation', 'uuid_link', 'uuid');
    }
}
