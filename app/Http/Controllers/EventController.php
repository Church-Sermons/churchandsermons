<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Organisation;
use Auth;
use Session;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:administrator|superadministrator|author')->except(['show', 'index']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uuid)
    {
        $events = Event::where('uuid_link', $uuid)->orderBy('id', 'desc')->paginate(10);

        return view('events.index')->withEvents($events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uuid)
    {
        $organisation = Organisation::where('uuid', $uuid)->first();
        return view('events.create')->withOrganisation($organisation);
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
            'title' => 'required|max:255',
            'description' => 'required',
            'address' => 'required',
            'poster' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);


        //upload image first
        if ($request->hasFile('poster')) {

            // add to db
            $event = new Event($request->except(['organisations', 'poster']));
            $event->poster = $request->poster->store('uploads', 'public');
            $event->uuid_link = $uuid;
            $event->save();

            Session::flash('success', 'Event Saved');

            return redirect()->route('organisations.events.index', $uuid);

        }else{

            Session::flash('error', 'Event failed to save');

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
        $event = Event::findOrFail($id);

        return view('events.show')->withEvent($event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
