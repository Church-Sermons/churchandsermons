<?php

namespace App\Traits;

use App\Contact;

trait ContactTrait
{
    protected function storeContacts($uuid, $request)
    {
        $validator = $request->validated();

        $contact = new Contact($request->all());
        $contact->uuid_link = $uuid;

        return [
            'contact' => $contact,
            'validator' => $validator
        ];
    }
}
