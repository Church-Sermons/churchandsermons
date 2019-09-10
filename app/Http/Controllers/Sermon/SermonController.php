<?php

namespace App\Http\Controllers\Sermon;

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

    public function __construct()
    {
        $this->middleware(
            'role:administrator|superadministrator|author'
        )->except(['index', 'show']);
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
            event(new ResourceCreationSuccessful($resource));

            Session::flash('success', 'Sermon added successfully');

            return redirect()->route('sermons.index');
        } else {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    }
}
