<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use Illuminate\Http\Request;
use App\OrganisationCategory;
use App\Profile;
use App\Traits\ProfileTrait;
use Auth;
use Session;
use DB;

class ProfileController extends Controller
{
    use ProfileTrait;

    private $_excepts;

    public function __construct()
    {
        $this->middleware(
            'role:administrator|superadministrator|author'
        )->except(['index', 'show']);

        $this->_excepts = ['profile_image', 'user_id', 'category'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::orderBy('id', 'desc')
            ->with('category')
            ->paginate(10);

        return view('profiles.main.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sites = DB::table('social_media')->get();
        return view('profiles.main.create', compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfileRequest $request)
    {
        $response = $this->storeProfile($request, $this->_excepts);

        if ($response['profile']->save()) {
            Session::flash('success', 'Profile created successfully');
            return redirect()->route('profiles.index');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($response['validator']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        // eager load relationships
        $profile = Profile::loadWithRelations($uuid);

        return view('profiles.main.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $profile = Profile::loadWithRelations($uuid);

        // restrict editing view to auth creators of the profile or admins or superadmins
        if (Auth::check() && Auth::user()->isTribrid($profile)) {
            return view('profiles.main.edit', compact('profile'));
        }

        return redirect()->route('profiles.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProfileRequest $request, $uuid)
    {
        $profile = Profile::getByUuid($uuid);

        // restrict editing view to auth creators of the profile or admins or superadmins
        if (Auth::check() && Auth::user()->isTribrid($profile)) {
            $response = $this->updateProfile(
                $profile,
                $request,
                $this->_excepts
            );

            if ($response['profile']->save()) {
                Session::flash('success', 'Profile updated successfully');
                return redirect()->route('profiles.index');
            } else {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($response['validator']);
            }
        } else {
            // redirect to index
            Session::flash(
                'danger',
                'Your are not authorized to perform this action'
            );
            return redirect()->route('profiles.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        // detach
        $profile = Profile::getByUuid($uuid);
        if (Auth::check() && Auth::user()->isTribrid($profile)) {
            // if user is tribrid can delete
            if ($profile->delete()) {
                Session::flash('success', 'Profile deleted successfully');

                return redirect()->back();
            } else {
                Session::flash('danger', 'Profile failed to delete');

                return redirect()->back();
            }
        } else {
            Session::flash(
                'danger',
                'You are not authorized to perform this action'
            );
            return redirect()->back();
        }
    }
}
