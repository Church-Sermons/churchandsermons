<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrganisationCategory;
use Session;

class OrganisationCategoryController extends Controller
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
        $categories = OrganisationCategory::orderBy('id', 'desc')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = null;

        $rules = [
            'name' => 'required|max:100',
            'linked_to' => 'required|max:50'
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'file|image|mimes:jpeg,png,jpg,gif,svg|max:5000';
            $image = $request->image;
        } elseif ($request->has('image_url')) {
            $rules['image_url'] = 'max:150|url';
            $image = $request->image_url;
        }

        $validator = $this->validate($request, $rules);

        $category = new OrganisationCategory();
        $category->name = $request->name;
        $category->linked_to = $request->linked_to;

        if ($category->save()) {
            // add successfull event for category
            // event(new CategoryCreationSuccessfull($category));
            Session::flash('success', 'Category added successfully');

            return redirect()->route('categories.index');
        } else {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
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
        $category = OrganisationCategory::findOrFail($id);

        return view('categories.show')->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = OrganisationCategory::findOrFail($id);

        return view('categories.edit')->withCategory($category);
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
        $this->validate($request, [
            'name' => 'required|max:100',
            'linked_to' => 'required|max:50'
        ]);

        $category = OrganisationCategory::findOrFail($id);
        $category->name = $request->name;
        $category->linked_to = $request->linked_to;

        if ($category->save()) {
            Session::flash('success', 'Category edited successfully');

            return redirect()->route('categories.show', $id);
        } else {
            return redirect()
                ->route('categories.edit')
                ->withInput();
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

    /**
     * Store category and return JSON
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeCategoryJSON(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'linked_to' => 'required|max:50'
        ]);

        $category = new OrganisationCategory();
        $category->name = $request->name;
        $category->linked_to = $request->linked_to;

        if ($category->save()) {
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Category Saved Successfully'
                ],
                201
            );
        } else {
            return response()->json([
                'status' => 'danger',
                'message' => 'Category Failed To Save'
            ]);
        }
    }
}
