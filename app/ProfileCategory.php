<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileCategory extends Model
{
     // timestamps
     public $timestamps = false;

     protected $fillable = ['name'];
}
