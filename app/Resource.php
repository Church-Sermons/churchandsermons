<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{

    public function category()
    {
        return $this->hasOne('App\OrganisationCategory', 'id', 'category_id');
    }
}
