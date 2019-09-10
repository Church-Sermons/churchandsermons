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
        // store working hours
        $this->storeWorkingSchedule($organisation);

        // Logic to input social links
        if (request()->has('social_id')) {
            //either of the two inputs must exist
            if (request()->has('share_link') || request()->has('page_link')) {
                // populate db
                $social = new SocialLink(request()->except('social_id'));
                $social->social_id = request()->social_id;
                $social->uuid_link = $organisation->uuid;
                $social->save();
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

    public function storeWorkingSchedule($model)
    {
        $dayOfWeek = request()->day_of_week;
        $timeOpen = request()->time_open;
        $workDuration = request()->work_duration;
        // Logic on multiple working schedules here
        // get data
        if ($dayOfWeek && $timeOpen && $workDuration) {
            $workingHours = [];
            foreach ($dayOfWeek as $key => $value) {
                $workingHours[] = [
                    'day_of_week' => $value,
                    'time_open' => $timeOpen[$key],
                    'work_duration' => $workDuration[$key]
                ];
            }

            // use one to many associate
            $model->schedules()->createMany($workingHours);
        }
    }
}
