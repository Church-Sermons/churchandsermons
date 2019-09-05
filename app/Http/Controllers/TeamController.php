<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organisation;
use App\Profile;
use App\OrganisationCategory;
use Auth;
use Session;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uuid)
    {
        $organisation = Organisation::where('uuid', $uuid)
            ->with('profiles')
            ->first();

        return view('organisations.team.index', compact(['organisation']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uuid)
    {
        $categories = OrganisationCategory::distinctCategoryNames();
        $organisation = Organisation::where('uuid', $uuid)->first();
        return view(
            'organisations.team.create',
            compact(['categories', 'organisation'])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $uuid)
    {
        $validator = $this->validate($request, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:profiles,email',
            'phone' =>
                'required|min:10|max:15|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{3,4}$/',
            'website' => 'required|max:150|url',
            'address' => 'required',
            'description' => 'required',
            'category' => 'required|numeric',
            'profile_image' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);

        // add data to profile
        $profile = new Profile($request->except(['profile_image', 'category']));
        if ($request->hasFile('profile_image')) {
            $profile->profile_image = $request->profile_image->store(
                'uploads',
                'public'
            );
        }

        $profile->category_id = $request->category;

        if ($profile->save()) {
            Session::flash('success', 'Member created successfully');
            return redirect()->back();
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid, $id)
    {
        $profile = Profile::findOrFail($id);
        $categories = OrganisationCategory::distinctCategoryNames();
        $organisation = Organisation::where('uuid', $uuid)->first();
        return view(
            'organisations.team.edit',
            compact(['profile', 'categories', 'organisation'])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid, $id)
    {
        // will be upgraded to include already available users to add
        $validator = $this->validate($request, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => "required|email|max:255|unique:profiles,email,$id",
            'phone' =>
                'required|min:10|max:15|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{3,4}$/',
            'website' => 'required|max:150|url',
            'address' => 'required',
            'description' => 'required',
            'category' => 'required|numeric',
            'profile_image' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);

        // add data to profile
        $profile = Profile::findOrFail($id);

        $data = array_merge($request->except(['profile_image', 'category']), [
            'category_id' => $request->category
        ]);

        if ($profile->update($data)) {
            Session::flash('success', 'Member edited successfully');
            return redirect()->back();
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
    public function destroy($uuid, $id)
    {
        $organisation = Organisation::where('uuid', $uuid)->first();

        // if exists detach
        if ($organisation && $organisation->profiles()->detach($id)) {
            Session::flash('success', 'Team member deleted successfully');
            return redirect()->back();
        } else {
            Session::flash('error', 'Team member not deleted');

            return redirect()->back();
        }
    }
}
