<?php

namespace App\Traits;

trait WorkScheduleTrait
{
    private $dayOfWeek;
    private $timeOpen;
    private $workDuration;
    private $schedule;

    protected function storeWorkSchedule($model, $request)
    {
        $validator = $request->validated();

        $this->dayOfWeek = $request->day_of_week;
        $this->timeOpen = $request->time_open;
        $this->workDuration = $request->work_duration;
        $this->schedule = null;
        $workingHours = [];
        // if work schedule == 'always, add whole week', else add only selected days
        if ($request->open_hours == 1) {
            // always // request dayofweek,timeopen,workduration
            $limit = 7;

            for ($i = 0; $i < $limit; $i++) {
                $workingHours[] = [
                    'day_of_week' => $i,
                    'time_open' => $request->o_time_open,
                    'work_duration' => $request->o_work_duration
                ];
            }
        } elseif ($request->open_hours == 2) {
            // Logic on multiple working schedules here
            // get data
            if ($this->dayOfWeek && $this->timeOpen && $this->workDuration) {
                foreach ($this->dayOfWeek as $key => $value) {
                    $workingHours[] = [
                        'day_of_week' => $value,
                        'time_open' => $this->timeOpen[$key],
                        'work_duration' => $this->workDuration[$value]
                    ];
                }
            }
        }

        // use one to many associate
        $this->schedule = $model->schedules()->createMany($workingHours);

        return [
            'schedule' => $this->schedule,
            'validator' => $validator
        ];
    }
}
