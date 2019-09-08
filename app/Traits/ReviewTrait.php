<?php

namespace App\Traits;

use App\Review;

trait ReviewTrait
{
    protected function storeReviews($uuid, $request, $uModel)
    {
        $validator = $request->validated();

        $review = new Review($request->all());
        $review->uuid_link = $uuid;
        $review->model = $uModel;

        return [
            'review' => $review,
            'validator' => $validator
        ];
    }
}
