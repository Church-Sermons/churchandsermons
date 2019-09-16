<?php

namespace App\Http\Controllers\Organisation;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkScheduleRequest;
use App\Organisation;
use App\Traits\WorkScheduleTrait;
use Session;
use App\WorkingSchedule;

class OrganisationWorkScheduleController extends Controller
{
    use WorkScheduleTrait;

    protected $name;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin|superadmin|author');

        $this->name = 'organisations';
    }

    public function create($uuid)
    {
        $model = Organisation::getByUuid($uuid);
        return view('work-schedule.create', compact('model'))->withName(
            $this->name
        );
    }

    public function store(StoreWorkScheduleRequest $request, $uuid)
    {
        // dd($request->all());
        $model = Organisation::getByUuid($uuid);

        $response = $this->storeWorkSchedule($model, $request);

        if ($response['schedule']) {
            Session::flash('success', 'Work Schedule stored successfully');

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
        $schedule = WorkingSchedule::findOrFail($id);

        if ($schedule->delete()) {
            Session::flash('success', 'Work schedule deleted');

            return redirect()->back();
        } else {
            Session::flash('danger', 'Work schedule not deleted');

            return redirect()->back();
        }
    }
}
