<?php

namespace App\Observers;

use App\Resource;
use Str;
use Route;
use App\Helpers\Helper;
use App\Organisation;

class ResourceObserver
{
    /**
     * Handle the resource "created" event.
     *
     * @param  \App\Resource  $resource
     * @return void
     */
    public function created(Resource $resource)
    {
        // check if route exists
        if (Route::current()->parameters['organisation_id']) {
            // syncing with other related table
            $organisation = Organisation::where(
                'uuid',
                Route::current()->parameters['organisation_id']
            )->first();

            // link to relation
            $organisation->resources()->syncWithoutDetaching($resource);
        }

        // add media
        if ($resource->category->name == 'video') {
            Helper::mediaAttacher($resource, [
                'file' => 'file_name',
                'name' => 'name',
                'collection' => 'video'
            ]);
        } elseif ($resource->category->name == 'audio') {
            Helper::mediaAttacher($resource, [
                'file' => 'file_name',
                'name' => 'name',
                'collection' => 'audio'
            ]);
        } elseif ($resource->category->name == 'document') {
            Helper::mediaAttacher($resource, [
                'file' => 'file_name',
                'name' => 'name',
                'collection' => 'document'
            ]);
        }
    }

    /**
     * Handle the resouce "creating" event.
     *
     * @param  \App\Resource  $resource
     * @return void
     */

    public function creating(Resource $resource)
    {
        // create a uuid
        $resource->uuid = Str::uuid();
    }

    /**
     * Handle the resource "updated" event.
     *
     * @param  \App\Resource  $resource
     * @return void
     */
    public function updated(Resource $resource)
    {
        //
    }

    /**
     * Handle the resource "deleted" event.
     *
     * @param  \App\Resource  $resource
     * @return void
     */
    public function deleted(Resource $resource)
    {
        //
    }

    /**
     * Handle the resource "restored" event.
     *
     * @param  \App\Resource  $resource
     * @return void
     */
    public function restored(Resource $resource)
    {
        //
    }

    /**
     * Handle the resource "force deleted" event.
     *
     * @param  \App\Resource  $resource
     * @return void
     */
    public function forceDeleted(Resource $resource)
    {
        //
    }
}
