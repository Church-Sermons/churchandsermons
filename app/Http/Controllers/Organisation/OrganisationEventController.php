<?php

namespace App\Http\Controllers\Organisation;

use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Organisation;
use App\Traits\EventTrait;
use Session;

class OrganisationEventController extends Controller
{
    use EventTrait;

    protected $name;

    public function __construct()
    {
        $this->middleware(
            'role:administrator|superadministrator|author'
        )->except(['show', 'index']);
        $this->name = 'organisations';
    }

    public function index($uuid)
    {
        $model = Organisation::getByUuid($uuid);

        return view('events.index', compact('model'))->withName($this->name);
    }

    public function create($uuid)
    {
        $model = Organisation::getByUuid($uuid);

        return view('events.create', compact('model'))->withName($this->name);
    }

    public function store(StoreEventRequest $request, $uuid)
    {
        $response = $this->storeEvents($request, $uuid);

        if ($response['event']->save()) {
            Session::flash('success', 'Event Created Successfully');

            return redirect()->route('organisations.show', $uuid);
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
        $event = Event::findOrFail($id);

        if ($event->delete()) {
            Session::flash('success', 'Event deleted successfully');
            return redirect()->route('organisations.show', $uuid);
        } else {
            Session::flash(
                'danger',
                'Oops.Something went wrong. Failed to delete event'
            );
            return redirect()->back();
        }
    }
}
