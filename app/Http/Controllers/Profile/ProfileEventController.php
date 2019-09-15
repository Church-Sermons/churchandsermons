<?php

namespace App\Http\Controllers\Profile;

use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Profile;
use App\Traits\EventTrait;
use Session;

class ProfileEventController extends Controller
{
    use EventTrait;

    protected $name;

    public function __construct()
    {
        $except = ['show', 'index'];
        $this->middleware('auth')->except($except);
        $this->middleware('role:admin|superadmin|author')->except($except);

        $this->name = 'profiles';
    }

    public function index($uuid)
    {
        $model = Profile::getByUuid($uuid);

        return view('events.index', compact('model'))->withName($this->name);
    }

    public function create($uuid)
    {
        $model = Profile::getByUuid($uuid);

        return view('events.create', compact('model'))->withName($this->name);
    }

    public function store(StoreEventRequest $request, $uuid)
    {
        $response = $this->storeEvents($request, $uuid);

        if ($response['event']->save()) {
            Session::flash('success', 'Event Created Successfully');

            return redirect()->route('profiles.show', $uuid);
        } else {
            return redirect()
                ->back()
                ->withErrors($response['validator'])
                ->withInput();
        }
    }

    public function show($uuid, $id)
    {
        $event = Event::findOrFail($id);

        return view('events.show', compact('event'));
    }

    public function edit($uuid, $id)
    {
        $event = Event::findOrFail($id);

        return view('events.edit', compact('event'))->withName($this->name);
    }

    public function update(StoreEventRequest $request, $uuid, $id)
    {
        $event = Event::findOrFail($id);

        $response = $this->updateEvents($event, $request, $uuid);

        if ($response['event']->save()) {
            Session::flash('success', 'Event updated successfully');

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
        $event = Event::findOrFail($id);

        if ($event->delete()) {
            Session::flash('success', 'Event deleted successfully');
            return redirect()->route('profiles.show', $uuid);
        } else {
            Session::flash(
                'danger',
                'Oops.Something went wrong. Failed to delete event'
            );
            return redirect()->back();
        }
    }
}
