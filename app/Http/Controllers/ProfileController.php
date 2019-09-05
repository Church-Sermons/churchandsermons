<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrganisationCategory;
use App\Profile;
use Auth;
use Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'role:administrator|superadministrator|author'
        )->except(['index', 'show']);
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

        return view('profiles.main.index')->withProfiles($profiles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = OrganisationCategory::all();
        return view('profiles.main.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validate($request, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:profiles,email',
            'phone' => 'required|max:20',
            'website' => 'required|max:150|url',
            'address' => 'required',
            'description' => 'required',
            'category' => 'required|numeric',
            'profile_image' =>
                'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);

        $profile = new Profile(
            $request->except(['profile_image', 'user_id', 'category'])
        );
        $profile->profile_image = $request->profile_image->store(
            'uploads',
            'public'
        );
        $profile->user_id = Auth::user()->id;
        $profile->category_id = $request->category;

        if ($profile->save()) {
            Session::flash('success', 'Profile created successfully');
            return redirect()->route('profiles.index');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
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
        $profile = Profile::where('uuid', $uuid)
            ->with(['category'])
            ->first();

        return view('profiles.main.show')->withProfile($profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $profile = Profile::where('uuid', $uuid)
            ->with('category')
            ->first();

        if ($profile->user_id != Auth::user()->id) {
            return redirect()->route('profiles.index');
        }

        $categories = OrganisationCategory::all();
        return view('profiles.main.edit')
            ->withProfile($profile)
            ->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $profile = Profile::where('uuid', $uuid)->first();

        if ($profile->user_id != Auth::user()->id) {
            Session::flash('error', 'Unauthorized Access');

            return redirect()->route('profiles.index');
        }

        $validator = $this->validate($request, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:20',
            'website' => 'required|max:150|url',
            'address' => 'required',
            'description' => 'required',
            'category' => 'required|numeric',
            'profile_image' =>
                'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);
        $profile->fill(
            $request->except(['profile_image', 'user_id', 'category'])
        );

        $profile->profile_image = $request->profile_image->store(
            'uploads',
            'public'
        );
        $profile->user_id = Auth::user()->id;
        $profile->category_id = $request->category;

        if ($profile->save()) {
            Session::flash('success', 'Profile updated successfully');
            return redirect()->route('profiles.index');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
