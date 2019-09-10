<?php

namespace App\Observers;

use App\Sermon;
use Str;
use Auth;

class SermonObserver
{
    /**
     * Handle the sermon "created" event.
     *
     * @param  \App\Sermon  $sermon
     * @return void
     */
    public function created(Sermon $sermon)
    {
    }

    /**
     * Handle the sermon "creating" event.
     *
     * @param  \App\Sermon  $sermon
     * @return void
     */
    public function creating(Sermon $sermon)
    {
        // create a uuid
        $sermon->uuid = Str::uuid();
        // associate with currently registered user
        if (Auth::check()) {
            $sermon->user_id = Auth::user()->id;
        }

        // link speakers
        $sermon->profiles()->syncWithoutDetaching(request()->speakers);
    }

    /**
     * Handle the sermon "updated" event.
     *
     * @param  \App\Sermon  $sermon
     * @return void
     */
    public function updated(Sermon $sermon)
    {
        //
    }

    /**
     * Handle the sermon "updating" event.
     *
     * @param  \App\Sermon  $sermon
     * @return void
     */
    public function updating(Sermon $sermon)
    {
    }

    /**
     * Handle the sermon "deleted" event.
     *
     * @param  \App\Sermon  $sermon
     * @return void
     */
    public function deleted(Sermon $sermon)
    {
        //
    }

    /**
     * Handle the sermon "restored" event.
     *
     * @param  \App\Sermon  $sermon
     * @return void
     */
    public function restored(Sermon $sermon)
    {
        //
    }

    /**
     * Handle the sermon "force deleted" event.
     *
     * @param  \App\Sermon  $sermon
     * @return void
     */
    public function forceDeleted(Sermon $sermon)
    {
        //
    }
}
