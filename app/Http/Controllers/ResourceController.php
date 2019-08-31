<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use App\OrganisationCategory;
use App\Organisation;
use Session;
use Auth;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uuid)
    {

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
        return view('resources.create')->withCategories($categories)->withOrganisation($organisation);

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
            'description' => 'required',
            'file_name' => 'required|file|max:20000'
        ]);

        $resource = new Resource();
        $resource->name = $request->name;
        $resource->description = $request->description;

        $resource->file_name = $request->file_name->storeAs('uploads/resources',
                                    time(). '.' .$request->file('file_name')->getClientOriginalExtension(), 'public');
        $resource->category_id = $request->category;


        if($resource->save()){
            // sync to organisation
            $organisation = Organisation::where('uuid', $uuid)->first();
            $organisation->resources()->syncWithoutDetaching($resource);
            $organisation->addMedia($request->file('file_name'))
                            ->preservingOriginal()->toMediaCollection();

            Session::flash('success', 'Resource created successfully');

            return redirect()->route('organisations.show', $uuid);
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
    public function show($org_id, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($org_id, $id)
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
