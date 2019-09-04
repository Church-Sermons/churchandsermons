<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganisationCategory extends Model
{
    // timestamps
    public $timestamps = false;

    protected $fillable = ['name', 'linked_to'];

    public function scopeDistinctCategoryNames($query)
    {
        return $query->get()->unique('name');
    }
}
