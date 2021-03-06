<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrganisationCategory;
use Session;

class OrganisationCategoryController extends Controller
{
    public function __construct()
    {
        $except = ['index', 'show'];
        $this->middleware('auth')->except($except);
        $this->middleware('role:admin|superadmin|author')->except($except);
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
        $validator = $this->validate($request, [
            'name' => 'required|max:100',
            'linked_to' => 'required|max:50'
        ]);

        $category = new OrganisationCategory();
        $category->name = $request->name;
        $category->linked_to = $request->linked_to;

        if ($category->save()) {
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

        return view('categories.show', compact('category'));
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

        return view('categories.edit', compact('category'));
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
        $validator = $this->validate($request, [
            'name' => 'required|max:100',
            'linked_to' => 'required|max:50'
        ]);

        $category = OrganisationCategory::findOrFail($id);
        $category->name = $request->name;
        $category->linked_to = $request->linked_to;

        if ($category->save()) {
            Session::flash('success', 'Category edited successfully');

            return redirect()->route('categories.index');
        } else {
            return redirect()
                ->back()
                ->withErrors($validator)
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
        $category = OrganisationCategory::findOrFail($id);

        if ($category->delete()) {
            Session::flash('success', 'Category Deleted Successfully');

            return redirect()->route('categories.index');
        } else {
            Session::flash('danger', 'Categories Failed To Delete');

            return redirect()->route('categories.index');
        }
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
