<?php

namespace App\Traits;
use App\Claim;
use Auth;

trait ClaimTrait
{
    protected function storeClaims($uuid, $request)
    {
        $validator = $request->validated();

        $claim = new Claim($request->all());
        $claim->sender_id = Auth::user()->id;
        $claim->uuid_link = $uuid;

        return [
            'claim' => $claim,
            'validator' => $validator
        ];
    }
}
