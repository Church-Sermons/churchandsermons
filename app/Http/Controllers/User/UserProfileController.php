<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserProfileRequest;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:author|administrator|superadministrator');
    }

    public function index()
    {
        return view('user.main.index');
    }

    public function updateUserProfile(StoreUserProfileRequest $request)
    {
        $validator = $request->validated();

        try {
            // get data to table
            $user = User::findOrFail($request->id);
            // update user data
            $user->fill($request->except('profile_image'));
            $user->surname = ucwords($request->surname);
            $user->name = ucwords($request->name);
            if ($request->hasFile('profile_image')) {
                $user->profile_image = $request->profile_image->store(
                    'uploads/user/images',
                    'public'
                );
            }

            if ($user->save()) {
                Session::flash('success', 'User details updated successfully');
                // delete image here
                return redirect()->back();
            } else {
                Session::flash('danger', 'User details failed to update');
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        } catch (ModelNotFoundException $e) {
            Session::flash('danger', '404. User not found');
            return redirect()->back();
        }
    }

    // password management
    public function securityIndex()
    {
        return view('user.main.password');
    }

    public function securityUpdate()
    {
    }
}
