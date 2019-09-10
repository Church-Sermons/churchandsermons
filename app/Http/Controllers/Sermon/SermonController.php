<?php

namespace App\Http\Controllers\Sermon;

use App\Events\ResouceUploadSuccessfull;
use App\Events\ResourceCreationSuccessful;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSermonRequest;
use App\Profile;
use App\Sermon;
use App\Traits\ResourceTrait;
use Auth;
use Session;

class SermonController extends Controller
{
    use ResourceTrait;

    protected $name;

    public function __construct()
    {
        $this->middleware(
            'role:administrator|superadministrator|author'
        )->except(['index', 'show']);

        $this->name = 'sermons';
    }

    public function index()
    {
        $sermons = Sermon::orderBy('id', 'desc')->paginate(10);

        return view('sermons.main.index', compact('sermons'));
    }

    public function create()
    {
        $id = Auth::user()->id;
        $speakers = Profile::where('user_id', $id)->get();

        return view('sermons.main.create', compact('speakers'));
    }

    public function store(StoreSermonRequest $request)
    {
        $validator = $request->validated();

        $sermon = new Sermon($request->except(['file_name', 'speakers']));

        $tag = $this->getTag($request);
        // add file
        $resource = $sermon
            ->addMedia($request->file_name)
            ->withCustomProperties([
                'name' => $request->title,
                'description' => $request->description,
                'category' => $tag['tag']
            ])
            ->toMediaCollection($tag['tag']);

        if ($sermon->save()) {
            // add metadata acquisition event
            event(new ResouceUploadSuccessfull($resource));

            Session::flash('success', 'Sermon added successfully');

            return redirect()->route('sermons.index');
        } else {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function show($uuid)
    {
        $sermon = Sermon::getByUuid($uuid);

        return view('sermons.main.show', compact('sermon'))->withName(
            $this->name
        );
    }

    public function edit($uuid)
    {
        $sermon = Sermon::getByUuid($uuid);
        $id = Auth::user()->id;
        $speakers = Profile::where('user_id', $id)->get();

        return view('sermons.main.edit', compact(['sermon', 'speakers']));
    }

    public function update(StoreSermonRequest $request, $uuid)
    {
        $sermon = Sermon::getByUuid($uuid);

        $validator = $request->validated();

        $sermon->fill($request->except(['file_name', 'speakers']));

        $tag = $this->getTag($request);
        // add file
        $resource = $sermon
            ->addMedia($request->file_name)
            ->withCustomProperties([
                'name' => $request->title,
                'description' => $request->description,
                'category' => $tag['tag']
            ])
            ->toMediaCollection($tag['tag']);

        if ($sermon->save()) {
            // update relationship sync
            $sermon->profiles()->sync($request->speakers);

            // add event to get metadata
            event(new ResouceUploadSuccessfull($resource));

            // delete resource - deletes db record and corresponding file - will update to $model->deleteMedia()
            // $sermon->deleteMedia($request->file_id);

            Session::flash('success', 'Sermon update successfull');

            return redirect()->route('sermons.show', $uuid);
        } else {
            redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function destroy($uuid)
    {
        $sermon = Sermon::getByUuid($uuid);

        if ($sermon->delete()) {
            // detach
            $sermon->profiles()->detach();

            Session::flash('success', 'Sermon deleted successfully');

            return redirect()->route('sermons.index');
        } else {
            Session::flash('danger', 'Sermon failed to delete');
            return redirect()->back();
        }
    }
}
