<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'message', 'subject'];

    public function organisation()
    {
        return $this->belongsTo('App\Organisation', 'uuid_link', 'uuid');
    }
}
