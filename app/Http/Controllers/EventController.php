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
        $this->middleware(
            'role:administrator|superadministrator|author'
        )->except(['show', 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uuid)
    {
        $organisation = Organisation::where('uuid', $uuid)->first();

        return view('events.index', compact('organisations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uuid)
    {
        $organisation = Organisation::where('uuid', $uuid)->first();
        return view('events.create', compact('organisation'));
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
            'poster' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);

        $event = new Event($request->except(['poster']));

        //upload image first
        if ($request->hasFile('poster')) {
            // add to db

            $event->poster = $request->poster->store('uploads', 'public');
        }

        $event->uuid_link = $uuid;

        if ($event->save()) {
            Session::flash('success', 'Event Saved');

            return redirect()->back();
        } else {
            Session::flash('error', 'Event failed to save');

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
        $event = Event::findOrFail($id);

        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid, $id)
    {
        $event = Event::findOrFail($id);

        return view('events.edit', compact(['event']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid, $id)
    {
        $validator = $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'address' => 'required',
            'poster' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);

        $event = Event::findOrFail($id);
        // $event->fill($request->except(['poster'])); // handled by observer
        // $event->uuid_link = $uuid;

        if (
            $event->update(
                array_merge($request->except(['poster']), [
                    'uuid_link' => $uuid
                ])
            )
        ) {
            Session::flash('success', 'Event Updated');

            return redirect()->back();
        } else {
            Session::flash('error', 'Event failed to update');

            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid, $id)
    {
        $event = Event::findOrFail($id);

        if ($event->delete()) {
            Session::flash('success', 'Event deleted');

            return redirect()->back();
        } else {
            Session::flash('danger', 'Event failed to delete');

            return redirect()->back();
        }
    }
}
