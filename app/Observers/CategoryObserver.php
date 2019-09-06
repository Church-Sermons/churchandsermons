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
