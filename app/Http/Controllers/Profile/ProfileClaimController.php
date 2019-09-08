<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Profile;
use App\Traits\ClaimTrait;
use Session;

class ProfileClaimController extends Controller
{
    use ClaimTrait;

    protected $name;

    public function __construct()
    {
        $this->middleware('role:administrator|superadministrator|author');
        $this->name = "profiles";
    }

    public function index($uuid)
    {
        $model = Profile::getByUuid($uuid);

        return view('claims.index', compact('model'));
    }

    public function create($uuid)
    {
        $model = Profile::getByUuid($uuid);

        return view('claims.create', compact('model'))->withName($this->name);
    }

    public function store(StoreMessageRequest $request, $uuid)
    {
        $response = $this->storeClaims($uuid, $request);

        if ($response['claim']->save()) {
            Session::flash('success', 'Claim sent successfully');

            return redirect()->route('profiles.show', $uuid);
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
