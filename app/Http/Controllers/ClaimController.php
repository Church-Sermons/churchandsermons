<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Claim;
use Auth;
use Session;

class ClaimController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:administrator|superadministrator')->except(['store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uuid)
    {
        $claims = Claim::where('uuid_link', $uuid)->orderBy('id', 'desc')->paginate(10);

        return view('claims.index')->withClaims($claims);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uuid)
    {
        return view('claims.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $uuid)
    {
        $validator = $this->validate($request, [
            'claim_subject' => 'required|max:255',
            'claim_message' => 'required',

        ]);

        $claim = new Claim();
        $claim->subject = $request->claim_subject;
        $claim->message = $request->claim_message;
        $claim->sender_id = Auth::user()->id;
        $claim->uuid_link = $uuid;

        if($claim->save()){
            Session::flash('success', 'Claim sent successfully');

            return redirect()->back();

        }else{

            return redirect()->back()->withErrors($validator)->withInput();
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
        $claim = Claim::where('id', $id)->first();

        return view('claims.show')->withClaim($claim);
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
    public function destroy($id)
    {
        $claim = Contact::findOrFail($id);

        if($claim->delete()){
            Session::flash('success', 'Claim deleted');

            return redirect()->route('claims.index');

        }else{

            Session::flash('error', 'Claim failed to delete');

            return redirect()->route('claims.index');
        }
    }
}
