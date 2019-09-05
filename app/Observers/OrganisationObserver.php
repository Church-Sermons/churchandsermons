<?php

namespace App\Observers;

use App\Organisation;
use Str;
use Auth;
use Storage;

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
        // associate with media library
        $organisation
            ->addMedia(request()->logo)
            ->usingName(request()->name . '-Logo')
            ->toMediaCollection('logo');
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
     * Handle the organisation "updated" event.
     *
     * @param  \App\Organisation  $organisation
     * @return void
     */
    public function updated(Organisation $organisation)
    {
        //
    }

    /**
     * Handle the organisation "updating" event.
     *
     * @param  \App\Organisation  $organisation
     * @return void
     */
    public function updating(Organisation $organisation)
    {
        // Deleting file on update
        if (empty(request()->logo)) {
            // empty request use already existing file in db
            $organisation->logo = $organisation->getOriginal('logo');
        } else {
            $mediaFile = $organisation->getFirstMediaUrl('logo');

            // save new logo image
            $organisation
                ->addMedia(request()->logo)
                ->usingName(request()->name . '-Logo')
                ->toMediaCollection('logo');

            // check if file exists in storage before delete
            $pathReplace = str_replace("/storage", "", $mediaFile);

            if (Storage::disk('public')->exists($pathReplace)) {
                $organisation->getMedia('logo')[0]->delete();
            }
        }

        $organisation->user_id = Auth::user()->id;
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
