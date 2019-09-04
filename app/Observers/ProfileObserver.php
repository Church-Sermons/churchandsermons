<?php

namespace App\Observers;

use App\Profile;
use App\Organisation;
use Str;
use Route;
use Auth;
use Storage;

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
        // check if route exists
        if (Route::current()->parameters['organisation_id']) {
            // syncing with other related table
            $organisation = Organisation::where(
                'uuid',
                Route::current()->parameters['organisation_id']
            )->first();

            // link to relation
            $organisation->profiles()->syncWithoutDetaching($profile);
        }
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
        // associate with currently registered user
        if (Auth::check()) {
            $profile->user_id = Auth::user()->id;
        }

        // check if image is empty
        if (empty(request()->profile_image)) {
            // add own path
            $profile->profile_image = 'images/default-logo.png';
        }
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
     * Handle the = profile "updating" event.
     *
     * @param  \App\Profile  $Profile
     * @return void
     */
    public function updating(Profile $profile)
    {
        // Deleting file on update
        if (empty(request()->profile_image)) {
            // empty request use already existing file in db
            $profile->profile_image = $profile->getOriginal('profile_image');
        } else {
            // get old profile image
            $oldProfile = $profile->profile_image;

            // save new profile image
            $profile->profile_image = request()->profile_image->store(
                'uploads',
                'public'
            );

            if (is_file(public_path('storage/' . $oldProfile))) {
                // delete old profile image
                Storage::disk('public')->delete($oldProfile);
            }
        }
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
