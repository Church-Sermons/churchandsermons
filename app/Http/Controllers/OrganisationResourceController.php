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
        return view('resources.index');
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
        return view('resources.create')
            ->withCategories($categories)
            ->withOrganisation($organisation);
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

        if ($request->category) {
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

        $resource = new Resource();
        $resource->name = $request->name;
        $resource->description = $request->description;
        // $resource->file_name = $request->file_name->storeAs(
        //     'uploads/resources',
        //     time() .
        //         '.' .
        //         $request->file('file_name')->getClientOriginalExtension(),
        //     'public'
        // );
        $resource->category_id = $request->category;

        if ($resource->save()) {
            // sync to organisation
            $organisation = Organisation::where('uuid', $uuid)->first();
            $organisation->resources()->syncWithoutDetaching($resource);

            if ($category->name == 'video') {
                $organisation
                    ->addMedia($request->file('file_name'))
                    ->usingName($request->name)
                    ->toMediaCollection('videos');
            } elseif ($category->name == 'document') {
                $organisation
                    ->addMedia($request->file('file_name'))
                    ->usingName($request->name)
                    ->toMediaCollection('documents');
            } elseif ($category->name == 'audio') {
                $organisation
                    ->addMedia($request->file('file_name'))
                    ->usingName($request->name)
                    ->toMediaCollection('audios');
            }

            Session::flash('success', 'Resource created successfully');

            return redirect()->route('organisations.show', $uuid);
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
