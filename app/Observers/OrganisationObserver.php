<?php

namespace App\Observers;

use App\Organisation;
use App\SocialLink;
use App\WorkingSchedule;
use Str;
use Auth;
use App\Helpers\Handler;

class OrganisationObserver
{
    /**
     * Handle the organisation "created" event.
     *
     * @param  \App\Organisation  $organisation
     * @return void
     */
    public function created(Organisation $organisation)
    {
    }

    /**
     * Handle the organisation "creating" event.
     *
     * @param  \App\Organisation  $organisation
     * @return void
     */

    public function creating(Organisation $organisation)
    {
        // create a uuid
        $organisation->uuid = Str::uuid();
        // link with auth user id
        if (Auth::check()) {
            $organisation->user_id = Auth::user()->id;
        }
    }

    /**
     * Handle the organisation "updating" event.
     *
     * @param  \App\Organisation  $organisation
     * @return void
     */
    public function updating(Organisation $organisation)
    {
        Handler::model($organisation)
            ->whileUpdating('logo')
            ->deleteImage();

        $organisation->user_id = Auth::user()->id;
    }

    /**
     * Handle the organisation "updated" event.
     *
     * @param  \App\Organisation  $organisation
     * @return void
     */
    public function updated(Organisation $organisation)
    {
    }

    /**
     * Handle the organisation "deleted" event.
     *
     * @param  \App\Organisation  $organisation
     * @return void
     */
    public function deleted(Organisation $organisation)
    {
        // Delete all media collections
        $organisation->clearMediaCollection();
    }

    /**
     * Handle the organisation "deleting" event.
     *
     * @param  \App\Organisation  $organisation
     * @return void
     */
    public function deleting(Organisation $organisation)
    {
    }

    /**
     * Handle the organisation "restored" event.
     *
     * @param  \App\Organisation  $organisation
     * @return void
     */
    public function restored(Organisation $organisation)
    {
        //
    }

    /**
     * Handle the organisation "force deleted" event.
     *
     * @param  \App\Organisation  $organisation
     * @return void
     */
    public function forceDeleted(Organisation $organisation)
    {
        //
    }
}
