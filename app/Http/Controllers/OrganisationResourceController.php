<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use App\OrganisationCategory;
use App\Organisation;
use Session;
use Auth;

class OrganisationResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uuid)
    {
        $organisation = Organisation::where('uuid', $uuid)->first();

        return view('resources.index', compact(['organisation']));
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

        return view(
            'resources.create',
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
        $rules = [
            'name' => 'required|max:255',
            'description' => 'required',
            'category' => 'required|numeric'
        ];

        if ($request->has('category')) {
            $category = OrganisationCategory::findOrFail($request->category);

            if ($category->name == 'audio') {
                $rules['file_name'] =
                    'required|file|mimes:mpga,wav,ogg,flac,aac,mp3';
            } elseif ($category->name == 'video') {
                $rules['file_name'] = 'required|file|mimes:mp4,flv,3gp,mkv,qt';
            } elseif ($category->name = 'document') {
                $rules['file_name'] =
                    'required|file|mimes:txt,html,doc,docx,ppt,pdf,csv';
            }
        }

        $validator = $this->validate($request, $rules);

        $resource = new Resource($request->except(['file_name', 'category']));
        $resource->category_id = $request->category;

        if ($resource->save()) {
            Session::flash('success', 'Resource created successfully');

            return redirect()->back();
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        // $resource->file_name = $request->file_name->storeAs(
        //     'uploads/resources',
        //     time() .
        //         '.' .
        //         $request->file('file_name')->getClientOriginalExtension(),
        //     'public'
        // );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid, $id)
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid, $id)
    {
        // detach from resource_links
        // delete using media library package
    }
}
