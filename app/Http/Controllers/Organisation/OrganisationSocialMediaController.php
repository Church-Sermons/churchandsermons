<?php

namespace App\Http\Controllers\Organisation;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSocialMediaRequest;
use App\Organisation;
use App\Traits\SocialMediaTrait;
use Session;
use App\SocialLink;

class OrganisationSocialMediaController extends Controller
{
    use SocialMediaTrait;

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
        return view('social-media.create', compact('model'))->withName(
            $this->name
        );
    }

    public function store(StoreSocialMediaRequest $request, $uuid)
    {
        $model = Organisation::getByUuid($uuid);

        $response = $this->storeSocialMedia($request, $model);

        if ($response['social']) {
            Session::flash(
                'success',
                'Social Media Links created successfully'
            );

            return redirect()->back();
        } else {
            return redirect()
                ->back()
                ->withErrors($response['validator'])
                ->withInput();
        }
    }

    public function destroy($uuid, $id)
    {
        $social = SocialLink::findOrFail($id);

        if ($social->delete()) {
            Session::flash('success', 'Social Media link deleted');

            return redirect()->back();
        } else {
            Session::flash('danger', 'Social Media link not deleted');

            return redirect()->back();
        }
    }
}
