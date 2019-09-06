<?php

namespace App\Observers;

use App\OrganisationCategory;
use Storage;

class CategoryObserver
{
    /**
     * Handle the organisation category "created" event.
     *
     * @param  \App\OrganisationCategory  $organisationCategory
     * @return void
     */
    public function created(OrganisationCategory $category)
    {
        //
    }

    /**
     * Handle the organisation category "creating" event.
     *
     * @param  \App\OrganisationCategory  $organisationCategory
     * @return void
     */
    public function creating(OrganisationCategory $category)
    {
        // check if request was provided
        if (request()->hasFile('image')) {
            $category
                ->addMediaFromRequest(request()->image)
                ->preservingOriginal()
                ->withCustomProperties([
                    'description' => request()->description
                ])
                ->usingName(request()->name)
                ->toMediaCollection('uploads');
        } elseif (request()->has('image_url')) {
            // download media with jobs
            $category
                ->addMediaFromUrl(request()->image_url)
                ->preservingOriginal()
                ->withCustomProperties([
                    'description' => request()->description
                ])
                ->usingName(request()->name)
                ->toMediaCollection('downloads');
        }
    }

    /**
     * Handle the organisation category "updated" event.
     *
     * @param  \App\OrganisationCategory  $organisationCategory
     * @return void
     */
    public function updated(OrganisationCategory $category)
    {
        //
    }

    /**
     * Handle the organisation category "deleted" event.
     *
     * @param  \App\OrganisationCategory  $organisationCategory
     * @return void
     */
    public function deleted(OrganisationCategory $category)
    {
        //
    }

    /**
     * Handle the organisation category "restored" event.
     *
     * @param  \App\OrganisationCategory  $organisationCategory
     * @return void
     */
    public function restored(OrganisationCategory $category)
    {
        //
    }

    /**
     * Handle the organisation category "force deleted" event.
     *
     * @param  \App\OrganisationCategory  $organisationCategory
     * @return void
     */
    public function forceDeleted(OrganisationCategory $category)
    {
        //
    }
}
