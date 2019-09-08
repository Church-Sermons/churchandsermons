<?php

namespace App\Observers;

use App\Review;
use Auth;

class ReviewObserver
{
    public function created(Review $review)
    {
        // once review created, calculate total then get average
        $reviewAvg = $review
            ->where('uuid_link', $review->uuid_link)
            ->avg('rating');

        $review_average = number_format($reviewAvg, 2, '.', '');

        // find model data based on uuid
        $model = $review->model::getByUuid($review->uuid_link);

        // attach review to model
        $model->average_review = $review_average;

        // save changes
        $model->save();
    }

    public function creating(Review $review)
    {
        $review->user_id = Auth::user()->id;
    }
}
