<?php

namespace App\Traits;

use Plank\Mediable\Mediable as BaseMediable;

trait Mediable
{
    use BaseMediable {
        media as _oldMedia;
    }

    public function media()
    {
        return $this->morphToMany(config('mediable.model'), 'multimedia')
            ->withPivot('tag', 'order')
            ->orderBy('order');
    }
}
