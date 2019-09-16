<?php

namespace App\Traits;

use App\Profile;

trait ProfileTrait
{
    protected function storeProfile($request, $excepts)
    {
        $validator = $request->validated();

        $profile = new Profile($request->except($excepts));

        if ($request->hasFile('profile_image')) {
            $profile->profile_image = $request->profile_image->store(
                'uploads/images',
                'public'
            );
        }

        $profile->category_id = $request->category;

        return [
            'validator' => $validator,
            'profile' => $profile
        ];
    }

    public function updateProfile($profile, $request, $excepts)
    {
        $validator = $request->validated();

        $profile->fill($request->except($excepts));
        if ($request->hasFile('profile_image')) {
            $profile->profile_image = $request->profile_image->store(
                'uploads/images',
                'public'
            );
        }
        $profile->category_id = $request->category;

        return [
            'validator' => $validator,
            'profile' => $profile
        ];
    }
}
