<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class Helper
{
    /**
     *
     * Helper to assign a font based on day or time from diffForHumans
     */
    public static function checkDuration($time)
    {
        if (is_null($time) || empty($time)) {
            return $time;
        }

        $duration = explode(" ", $time->diffForHumans());

        switch ($duration[1]) {
            case 'minutes':
            case 'minute':
            case 'hour':
            case 'hours':
            case 'seconds':
            case 'second':
                return 'far fa-clock';
                break;
            default:
                return 'far fa-calendar-alt';
                break;
        }
    }

    /**
     * Helper to return only date and month
     *
     */
    public static function dateFormatter($date)
    {
        if (is_null($date) || empty($date)) {
            return $date;
        }

        $new_date = explode(
            " ",
            explode(',', $date->toFormattedDateString())[0]
        );

        return $new_date;
    }

    /**
     * Helper to set default image if returns empty
     */

    public static function setFallbackLogoImage($imagePath)
    {
        // check if not null and exists in disk
        if (
            $imagePath &&
            Storage::disk('public')->exists(
                str_replace("/storage", "", $imagePath)
            )
        ) {
            return $imagePath;
        }

        // if error return image path for default image
        return asset('images/default-logo.png');
    }

    /**
     *
     * Star rating trial
     */

    public static function starRating($rating)
    {
        $max = 5;
        $store = array();

        if ($rating) {
            $rating = floor($rating);

            //  run for..loop - return filled stars
            for ($i = 0; $i < $rating; $i++) {
                $store[] = 'fas fa-star';
            }

            // return unfilled stars
            $diff = $max - $rating;

            for ($i = 0; $i < $diff; $i++) {
                $store[] = 'far fa-star';
            }

            return $store;
        } else {
            return $store;
        }
    }

    /**
     *
     * Category Extractor
     *
     */
    public static function categoryExtractor($categories, $key)
    {
        // check if categories exist && key is in array
        if (
            $categories->count() > 0 &&
            in_array($key, $categories->pluck('linked_to')->toArray())
        ) {
            return true;
        }

        return false;
    }

    /**
     *
     * Media Attachment
     *
     */
    public static function mediaAttacher($model, $data = [])
    {
        return $model
            ->addMedia(request()->file($data['file']))
            ->usingName(request()->input($data['name']))
            ->toMediaCollection($data['collection']);
    }
}
