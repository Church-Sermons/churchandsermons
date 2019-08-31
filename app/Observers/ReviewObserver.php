<?php

namespace App\Observers;

use App\Review;
use App\Organisation;

class ReviewObserver
{
     /**
     * Handle the review "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(Review $review)
    {
        // once review created, calculate total then get average
        $review_average = number_format($review->where('uuid_link', $review->uuid_link)->avg('rating'), 2, '.', '');

        // find organisation based on id
        $organisation = Organisation::where('uuid', $review->uuid_link)->first();

        // attach review to organisation
        $organisation->average_review = $review_average;

        // save changes
        $organisation->save();
    }
}
