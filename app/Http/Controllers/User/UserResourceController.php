<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResourceRequest;
use App\Traits\ResourceTrait;
use App\Events\ResouceUploadSuccessfull;
use Auth;
use Session;
use Spatie\MediaLibrary\Models\Media;

class UserResourceController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        $this->middleware('role:administrator|superadministrator|author');
    }

    public function index()
    {
        return view('user.resources.index');
    }

    public function create()
    {
        return view('user.resources.create');
    }

    public function store(StoreResourceRequest $request)
    {
        $user = Auth::user();

        $validator = $request->validated();

        $tag = $this->getTag($request);

        // add media to users
        // attach file to collection
        $resource = $user
            ->addMedia($request->file_name)
            ->withCustomProperties([
                'description' => $request->description,
                'name' => $request->name,
                'category' => $request->category
            ])
            ->toMediaCollection($tag['tag']);

        // check if successful
        if ($resource) {
            // add event to resources
            event(new ResouceUploadSuccessfull($resource));

            Session::flash('success', 'Resources added successfully');

            return redirect()->route('resources.index');
        } else {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function show($id)
    {
        $resource = Media::findOrFail($id);

        return view('user.resources.show', compact('resource'));
    }

    public function edit($id)
    {
        $resource = Media::findOrFail($id);

        return view('user.resources.edit', compact('resource'));
    }

    public function update(StoreResourceRequest $request, $id)
    {
        // add newly created resource
        $user = Auth::user();

        $validator = $request->validated();

        $tag = $this->getTag($request);

        // add media to users
        // attach file to collection
        $resource = $user
            ->addMedia($request->file_name)
            ->withCustomProperties([
                'description' => $request->description,
                'name' => $request->name,
                'category' => $request->category
            ])
            ->toMediaCollection($tag['tag']);

        // delete existing resource
        if ($resource) {
            // add event to resources
            event(new ResouceUploadSuccessfull($resource));

            Session::flash('success', 'Resource edited successfully');

            // delete
            $user->deleteMedia($id);

            return redirect()->route('resources.index');
        } else {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $user = Auth::user();

        if (empty($user->deleteMedia($id))) {
            Session::flash('success', 'Resource deleted');
            return redirect()->back();
        } else {
            Session::flash('danger', 'Resource failed to delete');

            return redirect()->back();
        }
    }
}
