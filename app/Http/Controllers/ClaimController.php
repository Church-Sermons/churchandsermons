<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Claim;
use App\Http\Requests\StoreMessageRequest;
use App\Organisation;
use Auth;
use Session;

class ClaimController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('role:admin|superadmin|author');
    }

    // Explode route prefix
    public function getRoutePrefix()
    {
        $customPrefix = "/";
        $prefix = request()
            ->route()
            ->getPrefix();

        if ($prefix) {
            $customPrefix = explode("/", $prefix)[0];
        }

        return $customPrefix;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request, $uuid)
    {
        dd($this->getRoutePrefix());

        $validator = $request->validated();

        $claim = new Claim($request->all());
        $claim->sender_id = Auth::user()->id;
        $claim->uuid_link = $uuid;

        if ($claim->save()) {
            Session::flash('success', 'Claim sent successfully');

            // redirect accordingly
            if ($this->getRoutePrefix() == 'profiles') {
                return redirect()->route('profiles.show', $uuid);
            } elseif ($this->getRoutePrefix() == 'organisations') {
                return redirect()->route('organisations.show', $uuid);
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid, $id)
    {
        $claim = Claim::findOrFail($id);

        return view('claims.show', compact('claim'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
