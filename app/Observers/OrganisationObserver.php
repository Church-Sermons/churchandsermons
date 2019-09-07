<?php

namespace App\Observers;

use App\Organisation;
use App\WorkingSchedule;
use Str;
use Auth;
use Storage;

class OrganisationObserver
{
    private $oldFile;
    /**
     * Handle the organisation "created" event.
     *
     * @param  \App\Organisation  $organisation
     * @return void
     */
    public function created(Organisation $organisation)
    {
        // Logic on multiple working schedules here
        // get data
        if (
            request()->has('day_of_week') &&
            request()->has('time_open') &&
            request()->has('work_duration')
        ) {
            // iterate through array make table
            foreach (request()->day_of_week as $key => $value) {
                // create an array for delivery
                $workingHours = array(
                    'day_of_week' => $value,
                    'time_open' => request()->time_open[$key],
                    'work_duration' => request()->work_duration[$key]
                );

                // add to db
                $ws = new WorkingSchedule($workingHours);
                $ws->uuid_link = $organisation->uuid;
                // save
                $ws->save();
            }
        }
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
        if (request()->hasFile('logo')) {
            // delete image
            if (
                Storage::disk('public')->exists(
                    $organisation->getOriginal('logo')
                )
            ) {
                Storage::disk('public')->delete(
                    $organisation->getOriginal('logo')
                );
            }
        }
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
