<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganisationRequest;
use Illuminate\Http\Request;
use App\Organisation;
use App\Traits\OrganisationTrait;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $this->_excepts = [
            'category',
            'logo',
            'slides',
            'day_of_week',
            'time_open',
            'work_duration',
            'social_id',
            'share_link',
            'page_link'
        ];
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
        $sites = DB::table('social_media')->get();
        return view('organisations.main.create', compact('sites'));
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
        $sites = DB::table('social_media')->get();

        return view(
            'organisations.main.edit',
            compact(['organisation', 'sites'])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $organisation = Organisation::getByUuid($uuid);

        $response = $this->updateOrganisation(
            $request,
            $organisation,
            $this->_excepts
        );

        if ($organisation->update($response['data'])) {
            // delete old data slides - get old slides
            $oldSlides = $response['slides']['oldSlides'];
            if (is_array($oldSlides) && count($oldSlides)) {
                // delete
                $destorySlides = Media::destroy($oldSlides);
                // log it
                Log::channel('custom')->info(
                    "Old slides deleted. Dump => {$destorySlides}"
                );
            }

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
}
