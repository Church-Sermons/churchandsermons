<?php

namespace App\Http\Controllers\Organisation;

use App\Http\Controllers\Controller;
use App\Organisation;
use App\Traits\ClaimTrait;
use App\Http\Requests\StoreMessageRequest;
use Session;

class OrganisationClaimController extends Controller
{
    use ClaimTrait;

    protected $name;

    public function __construct()
    {
        $except = ['create'];
        $this->middleware('auth')->except($except);
        $this->middleware('role:admin|superadmin|author')->except($except);

        $this->name = "organisations";
    }

    public function index($uuid)
    {
        $model = Organisation::getByUuid($uuid);

        return view('claims.index', compact('model'))->withName($this->name);
    }

    public function create($uuid)
    {
        $model = Organisation::getByUuid($uuid);

        return view('claims.create', compact('model'))->withName($this->name);
    }

    public function store(StoreMessageRequest $request, $uuid)
    {
        $response = $this->storeClaims($uuid, $request);

        if ($response['claim']->save()) {
            Session::flash('success', 'Claim sent successfully');

            return redirect()->route('organisations.show', $uuid);
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
