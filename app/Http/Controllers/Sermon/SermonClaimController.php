<?php

namespace App\Http\Controllers\Sermon;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Sermon;
use App\Traits\ClaimTrait;
use Session;

class SermonClaimController extends Controller
{
    use ClaimTrait;

    protected $name;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin|superadmin|author');

        $this->name = "sermons";
    }

    public function index($uuid)
    {
        $model = Sermon::getByUuid($uuid);

        return view('claims.index', compact('model'));
    }

    public function create($uuid)
    {
        $model = Sermon::getByUuid($uuid);

        return view('claims.create', compact('model'))->withName($this->name);
    }

    public function store(StoreMessageRequest $request, $uuid)
    {
        $response = $this->storeClaims($uuid, $request);

        if ($response['claim']->save()) {
            Session::flash('success', 'Claim sent successfully');

            return redirect()->route('sermons.show', $uuid);
        } else {
            return redirect()
                ->back()
                ->withErrors($response['validator'])
                ->withInput();
        }
    }

    public function destroy($uuid, $id)
    {
        $claim = Claim::findOrFail($id);

        if ($claim->delete()) {
            Session::flash('success', 'Claim deleted');

            return redirect()->back();
        } else {
            Session::flash('danger', 'Claim failed to delete');

            return redirect()->back();
        }
    }
}
