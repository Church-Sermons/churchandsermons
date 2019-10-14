<?php

namespace App\Http\Controllers\Profile;

use App\Events\ResouceUploadSuccessfull;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResourceRequest;
use App\Profile;
use App\Traits\ResourceTrait;
use Spatie\MediaLibrary\Models\Media;
use Session;

class ProfileResourceController extends Controller
{
    use ResourceTrait;

    protected $name;

    public function __construct()
    {
        $except = ['show', 'index'];
        $this->middleware('auth')->except($except);
        $this->middleware('role:admin|superadmin|author')->except($except);

        $this->name = 'profiles';
    }

    public function index($uuid)
    {
        $model = Profile::getByUuid($uuid);

        return view('resources.index', compact('model'))->withName($this->name);
    }

    public function create($uuid)
    {
        $model = Profile::getByUuid($uuid);

        return view('resources.create', compact('model'))->withName(
            $this->name
        );
    }

    public function store(StoreResourceRequest $request, $uuid)
    {
        $response = $this->storeResources($request, $uuid, 'App\Profile');

        if ($response['resource']) {
            // get media
            // add event to resources
            event(new ResouceUploadSuccessfull($response['resource']));

            Session::flash('success', 'Resource added successfully');

            return redirect()->route('profiles.show', $uuid);
        } else {
            return redirect()
                ->back()
                ->withErrors($response['validator'])
                ->withInput();
        }
    }

    public function edit($uuid, $id)
    {
        $resource = Media::findOrFail($id);

        return view('resources.edit', compact(['resource', 'uuid']))->withName(
            $this->name
        );
    }

    public function update(StoreResourceRequest $request, $uuid, $id)
    {
        $model = Profile::getByUuid($uuid);

        $response = $this->updateResources($request, $model);

        if ($response['resource']) {
            // add event to get metadata
            event(new ResouceUploadSuccessfull($response['resource']));

            // delete resource - deletes db record and corresponding file - will update to $model->deleteMedia()
            $model->deleteMedia($id);

            Session::flash('success', 'Resource update successfull');

            return redirect()->route('profiles.show', $uuid);
        } else {
            redirect()
                ->back()
                ->withErrors($response['validator'])
                ->withInput();
        }
    }

    public function destroy($uuid, $id)
    {
        // detach from resource_links
        $model = Profile::getByUuid($uuid);

        // delete using media library package
        if (empty($model->deleteMedia($id))) {
            Session::flash('success', 'Media deletion was successfull');
            return redirect()->back();
        } else {
            Session::flash('danger', 'Media failed to delete');
            return redirect()->back();
        }
    }
}
