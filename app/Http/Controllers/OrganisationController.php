<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organisation;
use App\OrganisationCategory;
use Session;
use Auth;
use App\User;

class OrganisationController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:administrator|superadministrator|author')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $organisations = Organisation::orderBy('id', 'desc')->with('category')->paginate(10);

        return view('organisations.main.index')->withOrganisations($organisations);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = OrganisationCategory::all();
        return view('organisations.main.create')->withCategories($categories);
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
            'email' => 'required|email|max:255|unique:organisations,email',
            'phone' => 'required|max:20',
            'website' => 'required|max:150|url',
            'address' => 'required',
            'description' => 'required',
            'category' => 'required|numeric',
            'logo' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);

        // store to db
        $organisation = new Organisation();
        $organisation->name = $request->name;
        $organisation->email = $request->email;
        $organisation->phone = $request->phone;
        $organisation->website = $request->website;
        $organisation->address = $request->address;
        $organisation->lat = $request->lat;
        $organisation->lon = $request->lon;
        $organisation->description = $request->description;
        $organisation->category_id = $request->category;
        $organisation->logo = $request->logo->store('uploads', 'public');
        $organisation->user_id = Auth::user()->id;

        if($organisation->save()){
            Session::flash('success', 'Organisation created successfully');
            return redirect()->route('organisations.index');
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
    public function show($uuid)
    {
        $organisation = Organisation::where('uuid', $uuid)->with(['category', 'reviews'])->first();

        return view('organisations.main.show')->withOrganisation($organisation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $organisation = Organisation::where('uuid', $uuid)->with('category')->first();

        if($organisation->user_id != Auth::user()->id){

            return redirect()->route('organisations.index');
        }
        $categories = OrganisationCategory::all();
        return view('organisations.main.edit')->withOrganisation($organisation)
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
        $organisation = Organisation::where('uuid', $uuid)->first();

        if($organisation->user_id != Auth::user()->id){
            Session::flash('error', 'Unauthorized Access');

            return redirect()->route('organisations.index');
        }

        $validator = $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:20',
            'website' => 'required|max:150|url',
            'address' => 'required',
            'description' => 'required',
            'category' => 'required|numeric',
            'logo' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);

        // store to db

        $organisation->name = $request->name;
        $organisation->email = $request->email;
        $organisation->phone = $request->phone;
        $organisation->website = $request->website;
        $organisation->address = $request->address;
        $organisation->lat = $request->lat;
        $organisation->lon = $request->lon;
        $organisation->description = $request->description;
        $organisation->category_id = $request->category;
        $organisation->logo = $request->logo->store('uploads', 'public');
        $organisation->user_id = Auth::user()->id;

        if($organisation->save()){
            Session::flash('success', 'Organisation updated successfully');
            return redirect()->route('organisations.index');
        }else{

            return redirect()->back()->withInput()->withErrors($validator);
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
