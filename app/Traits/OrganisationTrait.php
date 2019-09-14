<?php

namespace App\Traits;

use App\Organisation;
use Config;

trait OrganisationTrait
{
    protected function storeOrganisation($request, $excepts)
    {
        $validator = $request->validated();

        // store to db
        $organisation = new Organisation($request->except($excepts));
        $organisation->category_id = $request->category;
        // if logo exists
        if ($request->hasFile('logo')) {
            $organisation->logo = $request->logo->store(
                'uploads/images',
                'public'
            );
        } else {
            $organisation->logo = Config::get(
                'site_variables.defaults.main.organisation'
            );
        }

        // check if slides exists then upload them
        $slides = $this->uploadSlides($request, $organisation);

        return [
            'organisation' => $organisation,
            'validator' => $validator,
            'slides' => $slides
        ];
    }

    protected function updateOrganisation($model, $request, $excepts)
    {
        $validator = $request->validated();

        // merge for update
        $data = array_merge($request->except($excepts), [
            'category_id' => $request->category,
            'logo' => $request->hasFile('logo')
                ? $request->logo->store('uploads/images', 'public')
                : $model->logo
        ]);

        return [
            'data' => $data,
            'validator' => $validator
        ];
    }

    private function uploadSlides($request, $model)
    {
        if ($request->has('slides')) {
            // get ids of previous slides
            $oldSlides = [];
            $var = $model->getMedia('slides');

            if (is_array($var) && count($var)) {
                // pluck id if exists
                $oldSlides = $var->pluck('id')->toArray();
            }

            // upload files
            $slides = $model
                ->addMultipleMediaFromRequest(['slides'])
                ->each(function ($fileAdder) use ($model) {
                    $fileAdder
                        ->withCustomProperties([
                            'name' => $model->name,
                            'description' => $model->description
                        ])
                        ->toMediaCollection('slides');
                });

            return [
                'slides' => $slides,
                'oldSlides' => $oldSlides
            ];
        }
    }

    public function storeWorkingSchedule($model, $request)
    {
        $dayOfWeek = $request->day_of_week;
        $timeOpen = $request->time_open;
        $workDuration = $request->work_duration;
        // Logic on multiple working schedules here
        // get data
        if ($dayOfWeek && $timeOpen && $workDuration) {
            $workingHours = [];
            foreach ($dayOfWeek as $key => $value) {
                $workingHours[] = [
                    'day_of_week' => $value,
                    'time_open' => $timeOpen[$key],
                    'work_duration' => $workDuration[$key]
                ];
            }

            // use one to many associate
            $schedule = $model->schedules()->createMany($workingHours);

            return $schedule;
        }

        return null;
    }

    public function storeSocialMedia($model, $request)
    {
        // dd($request->all());

        $socialId = $request->social_id;
        $shareLink = $request->share_link;
        $pageLink = $request->page_link;

        if ($socialId && ($shareLink || $pageLink)) {
            $social = [];

            foreach ($socialId as $key => $value) {
                $social[] = [
                    'social_id' => $value,
                    'share_link' => $shareLink[$key],
                    'page_link' => $pageLink[$key]
                ];
            }

            $response = $model->social()->createMany($social);

            return $response;
        }

        return null;
    }
}
