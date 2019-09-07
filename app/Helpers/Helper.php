<?php

namespace App\Helpers;

use FFMpeg\FFProbe;
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
    public static $imagePath = null;
    public static function displayImage($imagePath)
    {
        // check if null
        if ($imagePath) {
            static::$imagePath = $imagePath;
        }

        return new static();
    }

    public function fromMediaLibrary()
    {
        // do ops based on path
        if (
            Storage::disk('public')->exists(
                str_replace("/storage", "", static::$imagePath)
            )
        ) {
            return static::$imagePath;
        }

        return null;
    }

    public function fromOwnTable()
    {
        return '/storage/' . static::$imagePath;
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

    /**
     *
     * Return Media Metadata
     *
     */
    public static $file = null;
    public static $duration;
    public static $artist;
    public static $title;
    public static $ffprobe;

    public static function media($file)
    {
        static::$file = $file;

        if (static::$file) {
            if (app()->environment() == 'local') {
                static::$ffprobe = FFProbe::create([
                    'ffprobe.binaries' => env(
                        'FFPROBE_PATH',
                        'C:/binaries/ffmpeg/bin/ffprobe.exe'
                    )
                ])->format(static::$file);
            } else {
                static::$ffprobe = FFProbe::create()->format(static::$file);
            }
        }

        return new static();
    }

    // return duration
    public function getDuration()
    {
        static::$duration = static::$ffprobe->get('duration');

        return gmdate("i:s", static::$duration);
    }

    // return title
    public function getTitle()
    {
        static::$title = static::$ffprobe->get('tags')['title'];

        return static::$title;
    }

    // return artist
    public function getArtist()
    {
        static::$artist = static::$ffprobe->get('tags')['artist'];

        return static::$artist;
    }

    // org show calculate time
    public static $total;
    public static function sumTime($time, $duration)
    {
        static::$total = 0;
        $limit = 24;

        if ($time && $duration) {
            static::$total = $time + $duration;

            // if > 24
            if (static::$total > $limit) {
                static::$total = $limit - static::$total;
            }
        }

        return new static();
    }

    public function isFullyFormatted()
    {
        return strval(number_format(static::$total, 2, ':', ''));
    }
}
