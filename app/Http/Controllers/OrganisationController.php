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
        $organisations = Organisation::orderBy('id', 'desc')
            ->with('category')
            ->paginate(10);

        return view('organisations.main.index', compact(['organisations']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = OrganisationCategory::all()->unique('name');

        return view('organisations.main.create', compact(['categories']));
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
            'logo' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);

        // store to db
        $organisation = new Organisation(
            $request->except(['category', 'logo'])
        );
        $organisation->category_id = $request->category;
        // $organisation->logo = $request->logo->store('uploads', 'public');

        if ($organisation->save()) {
            Session::flash('success', 'Organisation created successfully');
            return redirect()->route('organisations.index');
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
        $organisation = Organisation::where('uuid', $uuid)
            ->with(['category', 'reviews'])
            ->first();

        return view('organisations.main.show', compact(['organisation']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $organisation = Organisation::where('uuid', $uuid)->first();

        $categories = OrganisationCategory::distinctCategoryNames();

        return view(
            'organisations.main.edit',
            compact(['organisation', 'categories'])
        );
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

        $validator = $this->validate($request, [
            'name' => 'required|max:255',
            'email' => "required|email|max:255|unique:organisations,email,$organisation->id",
            'phone' => 'required|max:20',
            'website' => 'required|max:150|url',
            'address' => 'required',
            'description' => 'required',
            'category' => 'required|numeric',
            'logo' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);

        // merge for update
        $data = array_merge($request->except(['category', 'logo']), [
            'category_id' => $request->category
        ]);

        if ($organisation->update($data)) {
            Session::flash('success', 'Organisation updated successfully');
            return redirect()->route('organisations.index');
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
    public function destroy($uuid)
    {
        $organisation = Organisation::where('uuid', $uuid)->first();

        if ($organisation->delete()) {
            Session::flash('success', 'Organisation deleted successfully');

            return redirect()->route('organisations.index');
        } else {
            Session::flash('danger', 'Organisation failed to delete');

            return redirect()->route('organisations.index');
        }
    }
}
