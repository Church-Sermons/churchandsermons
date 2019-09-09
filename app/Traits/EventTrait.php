<?php

namespace App\Traits;

use App\Event;

trait EventTrait
{
    protected function storeEvents($request, $uuid)
    {
        $validator = $request->validated();

        $event = new Event($request->except(['poster']));

        //upload image first
        if ($request->hasFile('poster')) {
            // add to db

            $event->poster = $request->poster->store(
                'uploads/images',
                'public'
            );
        }

        $event->uuid_link = $uuid;

        return [
            'event' => $event,
            'validator' => $validator
        ];
    }

    protected function updateEvents($event, $request, $uuid)
    {
        $validator = $request->validated();

        $data = array_merge($request->except('poster'), ['uuid_link' => $uuid]);
        $event->fill($data);
        // update poster then delete it
        $event->poster = $request->poster->store('uploads/images', 'public');

        return [
            'event' => $event,
            'validator' => $validator
        ];
    }
}
