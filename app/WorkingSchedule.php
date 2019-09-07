<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingSchedule extends Model
{
    protected $table = 'working_schedule';

    protected $fillable = ["day_of_week", "time_open", "work_duration"];
}
