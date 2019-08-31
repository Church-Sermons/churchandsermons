<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Session;

class ContactController extends Controller
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
        $contacts = Contact::where('uuid_link', $uuid)->orderBy('id', 'desc')->paginate(10);

        return view('contacts.index')->withContacts($contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uuid)
    {
        return view('contacts.create');
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
            'name' => 'required|max:150',
            'email' => 'required|max:150',
            'subject' => 'required|max:255',
            'message' => 'required',
        ]);

        $contact = new Contact($request->all());
        $contact->uuid_link = $uuid;

        if($contact->save()){
            Session::flash('success', 'Message sent successfully');

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
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);

        if($contact->delete()){
            Session::flash('success', 'Message deleted');

            return redirect()->route('contacts.index');

        }else{

            Session::flash('error', 'Message failed to delete');

            return redirect()->route('contacts.index');
        }
    }
}
