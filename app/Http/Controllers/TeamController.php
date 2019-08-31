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
        $organisation = Organisation::where('uuid', $uuid)->with('profiles')->first();

        return view('organisations.team.index')->withOrganisation($organisation);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uuid)
    {
        $categories = OrganisationCategory::all();
        $organisation = Organisation::where('uuid', $uuid)->first();
        return view('organisations.team.create')->withCategories($categories)->withOrganisation($organisation);
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
            'phone' => 'required|max:20',
            'website' => 'required|max:150|url',
            'address' => 'required',
            'description' => 'required',
            'category' => 'required|numeric',
            'profile_image' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);

        // add data to profile
        $profile = new Profile($request->except(['profile_image', 'user_id', 'category']));
        $profile->profile_image = $request->profile_image->store('uploads', 'public');
        $profile->user_id = Auth::user()->id;
        $profile->category_id = $request->category;


        if($profile->save()){
            // sync organisation
            $organisation = Organisation::where('uuid', $uuid)->first();
            $organisation->profiles()->syncWithoutDetaching($profile);

            Session::flash('success', 'Member created successfully');
            return redirect()->route('organisations.team.index', $uuid);
        }else{

            return redirect()->back()->withInput()->withErrors($validator);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
