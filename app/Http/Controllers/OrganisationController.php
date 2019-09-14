<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGeneralSettingsRequest;
use App\Http\Requests\StoreOrganisationRequest;
use App\Http\Requests\StoreOrganisationSlidesRequest;
use App\Organisation;
use App\SocialLink;
use App\Traits\OrganisationTrait;
use App\WorkingSchedule;
use Session;
use Spatie\MediaLibrary\Models\Media;

class OrganisationController extends Controller
{
    use OrganisationTrait;

    protected $name;
    private $_excepts;

    public function __construct()
    {
        $this->middleware(
            'role:administrator|superadministrator|author'
        )->except(['index', 'show']);

        $this->name = 'organisations';
        $this->_excepts = ['category', 'logo'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organisations = Organisation::orderBy('id', 'desc')
            ->with('category')
            ->paginate(10);

        return view('organisations.main.index', compact('organisations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organisations.main.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrganisationRequest $request)
    {
        $response = $this->storeOrganisation($request, $this->_excepts);

        if ($response['organisation']->save()) {
            Session::flash('success', 'Organisation created successfully');
            return redirect()->route('organisations.index');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($response['validator']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $organisation = Organisation::where('uuid', $uuid)
            ->with(['category', 'reviews'])
            ->first();

        return view(
            'organisations.main.show',
            compact(['organisation'])
        )->withName($this->name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $organisation = Organisation::getByUuid($uuid);

        return view('organisations.main.edit', compact('organisation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrganisationRequest $request, $uuid)
    {
        $organisation = Organisation::getByUuid($uuid);

        $response = $this->updateOrganisation(
            $organisation,
            $request,
            $this->_excepts
        );

        if ($organisation->update($response['data'])) {
            Session::flash('success', 'Organisation updated successfully');

            return redirect()->route('organisations.index');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($response['validator']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $organisation = Organisation::getByUuid($uuid);

        if ($organisation->delete()) {
            Session::flash('success', 'Organisation deleted successfully');

            return redirect()->route('organisations.index');
        } else {
            Session::flash('danger', 'Organisation failed to delete');

            return redirect()->route('organisations.index');
        }
    }

    /**
     *
     * Caution! This code is messed up, even I don't understand any of it
     */

    // Slides
    public function createSlides($uuid)
    {
        $organisation = Organisation::getByUuid($uuid);

        return view(
            'organisations.main.slides.create',
            compact('organisation')
        );
    }

    // additional coding
    public function storeSlides(StoreOrganisationSlidesRequest $request, $uuid)
    {
        $validator = $request->validated();

        $organisation = Organisation::getByUuid($uuid);
        $slides = null;

        if ($request->hasFile('slides')) {
            // upload slides
            $slides = $organisation
                ->addMultipleMediaFromRequest(['slides'])
                ->each(function ($fileAdder) use ($organisation) {
                    $fileAdder
                        ->withCustomProperties([
                            'name' => $organisation->name,
                            'description' => $organisation->description
                        ])
                        ->toMediaCollection('slides');
                });
        }

        if ($slides) {
            Session::flash('success', 'Slides added successfully');

            return redirect()->back();
        } else {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function deleteSlides($uuid, $id)
    {
        // delete media
        $media = Media::findOrFail($id);

        if ($media->delete()) {
            Session::flash('success', 'Slide deleted successfully');

            return redirect()->back();
        } else {
            Session::flash('danger', 'Slide failed to delete');

            return redirect()->back();
        }
    }

    // general settings
    public function createGeneralSettings($uuid)
    {
        $organisation = Organisation::getByUuid($uuid);

        return view(
            'organisations.main.general.create',
            compact('organisation')
        );
    }

    public function storeGeneralSettings(
        StoreGeneralSettingsRequest $request,
        $uuid
    ) {
        $validator = $request->validated();

        $organisation = Organisation::getByUuid($uuid);

        $schedule = $this->storeWorkingSchedule($organisation, $request);
        $social = $this->storeSocialMedia($organisation, $request);

        if ($social && $schedule) {
            Session::flash('success', 'Data stored successfully');

            return redirect()->back();
        } else {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function deleteWorkSchedule($uuid, $id)
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

    public function deleteSocialMedia($uuid, $id)
    {
        $social = SocialLink::findOrFail($id);

        if ($social->delete()) {
            Session::flash('success', 'Social media link deleted');

            return redirect()->back();
        } else {
            Session::flash('danger', 'Social media link not deleted');

            return redirect()->back();
        }
    }
}
