<?php

namespace App\Observers;

use App\Profile;
use App\Organisation;
use Str;

class ProfileObserver
{
    /**
     * Handle the = profile "created" event.
     *
     * @param  \App\Profile  $Profile
     * @return void
     */
    public function created(Profile $profile)
    {

    }

    /**
     * Handle the profile "creating" event.
     *
     * @param  \App\Profile  $profile
     * @return void
     */

    public function creating(Profile $profile)
    {
        // create a uuid
        $profile->uuid = Str::uuid();

    }

    /**
     * Handle the = profile "updated" event.
     *
     * @param  \App\Profile  $Profile
     * @return void
     */
    public function updated(Profile $profile)
    {
        //
    }

    /**
     * Handle the = profile "deleted" event.
     *
     * @param  \App\Profile  $Profile
     * @return void
     */
    public function deleted(Profile $profile)
    {
        //
    }

    /**
     * Handle the = profile "restored" event.
     *
     * @param  \App\Profile  $Profile
     * @return void
     */
    public function restored(Profile $profile)
    {
        //
    }

    /**
     * Handle the = profile "force deleted" event.
     *
     * @param  \App\Profile  $Profile
     * @return void
     */
    public function forceDeleted(Profile $profile)
    {
        //
    }
}
