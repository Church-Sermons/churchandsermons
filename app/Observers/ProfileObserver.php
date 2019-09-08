<?php

namespace App\Observers;

use App\Profile;
use App\Organisation;
use App\ProfileLink;
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
        // code for team syncing with profiles page
        // check if name is same as team
        $logic = request()
            ->route()
            ->getName();
        // a small hack, might find a better way later
        // saves profiles to profiles table from organisation team if route is the same
        if ($logic == 'organisations.team.store') {
            $route = Route::current()->parameters['organisation_id'];
            if ($route) {
                // syncing with other related table
                $organisation = Organisation::where('uuid', $route)->first();

                // link to relation
                $organisation->profiles()->syncWithoutDetaching($profile);
            }
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
        if ($profile->isDirty('profile_image')) {
            // get old profile image
            $oldProfile = $profile->getOriginal('profile_image');

            // $oldProfile = "{$oldProfile[0]}/images/{$oldProfile[1]}";

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
