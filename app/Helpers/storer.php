<?php

function sayHi()
{
    return 'Hello World';
}

function generateHours()
{
    $dayTimes = [];
    foreach (range(1, 24) as $number) {
        if ($number < 12) {
            $dayTimes[] = "{$number}:00 AM";
        } elseif ($number >= 12 && $number < 24) {
            $dayTimes[] = "{$number}:00 PM";
        } else {
            $dayTimes[] = "{$number}:00 AM";
        }
    }

    return $dayTimes;
}
