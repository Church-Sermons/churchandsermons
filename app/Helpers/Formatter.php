<?php

namespace App\Helpers;

class Formatter
{
    public static $day;
    // pass in value, return day

    // check if day is same as other,if same take second date and
    public static function getDay($id)
    {
        return null;
    }

    public static function getTime($time, $duration)
    {
        $total = 0;
        $limit = 24;
        if ($time && $duration) {
            $total = $time + $duration;

            // if > 24
            if ($total > $limit) {
                $total = $limit - $total;
            }
        }

        return $total;
    }
}
