<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use App\OrganisationCategory;
use App\Organisation;
use Session;
use Auth;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use Plank\Mediable\MediaUploader;

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
        $categories = OrganisationCategory::distinctCategoryNames();
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

        $tag = 'assets';

        if ($request->has('category')) {
            $category = OrganisationCategory::findOrFail($request->category);

            if ($category->name == 'audio') {
                $rules['file_name'] =
                    'required|file|mimes:mpga,wav,ogg,flac,aac,mp3';
                $tag = "audio";
            } elseif ($category->name == 'video') {
                $rules['file_name'] = 'required|file|mimes:mp4,flv,3gp,mkv,qt';
                $tag = "videos";
            } elseif ($category->name = 'document') {
                $rules['file_name'] =
                    'required|file|mimes:txt,html,doc,docx,ppt,pdf,csv';
                $tag = "documents";
            }
        }

        $validator = $this->validate($request, $rules);

        // using laravel media library
        $organisation = Organisation::where('uuid', $uuid)->first();

        // attach file here based on collection
        $result = $organisation
            ->addMedia($request->file_name)
            ->usingName($request->name)
            ->withCustomProperties([
                'description' => $request->description
            ])
            ->toMediaCollection($tag);

        if ($result) {
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
        $organisation = Organisation::where('uuid', $uuid)->first();

        // delete using media library package
        if ($organisation->deleteMedia($id)) {
            Session::flash('success', 'Media deletion was successfull');
            return redirect()->back();
        } else {
            Session::flash('danger', 'Media failed to delete');
            return redirect()->back();
        }
    }
}
