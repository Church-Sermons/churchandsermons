<?php

namespace App\Helpers;

class Helper
{
    /**
     *
     * Helper to assign a font based on day or time from diffForHumans
     */
    public static function checkDuration($time)
    {
        if(is_null($time) || empty($time)){
            return $time;
        }

        $duration = explode(" ", $time->diffForHumans());

        switch ($duration[1])
        {
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
        if(is_null($date) || empty($date)){
            return $date;
        }

        $new_date = explode(" ", explode(',',$date->toFormattedDateString())[0]);

        return $new_date;
    }


}
