<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Organisation;
use Session;

class ContactController extends Controller
{
    public function __construct()
    {
        $except = ['store', 'create'];
        $this->middleware('auth')->except($except);
        $this->middleware('role:admin|superadmin|author')->except($except);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uuid)
    {
        $organisation = Organisation::where('uuid', $uuid)->first();

        return view('contacts.index')->withOrganisation($organisation);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uuid)
    {
        $organisation = Organisation::where('uuid', $uuid)->first();
        return view('contacts.create')->withOrganisation($organisation);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $uuid)
    {
        // get route prefix
        $route = $request->route()->getPrefix();
        $prefix = explode("/", $route)[0];

        $validator = $this->validate($request, [
            'name' => 'required|max:150',
            'email' => 'required|max:150',
            'subject' => 'required|max:255',
            'message' => 'required'
        ]);

        $contact = new Contact($request->all());
        $contact->uuid_link = $uuid;

        if ($contact->save()) {
            Session::flash('success', 'Message sent successfully');

            return redirect()->back();
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
        $contact = Contact::where('id', $id)->first();

        return view('contacts.show')->withContact($contact);
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
        $contact = Contact::findOrFail($id);

        if ($contact->delete()) {
            Session::flash('success', 'Message deleted');

            return redirect()->back();
        } else {
            Session::flash('danger', 'Message failed to delete');

            return redirect()->back();
        }
    }
}
