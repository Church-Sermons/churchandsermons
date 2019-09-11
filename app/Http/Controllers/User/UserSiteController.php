<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class UserSiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:administrator|superadministrator');
    }

    public function siteAboutEdit()
    {
        $details = DB::table('site_details')->first();
        return view('user.site.about', compact('details'));
    }

    public function siteAboutUpdate(Request $request)
    {
        $validator = $request->validate([
            'description' => 'required|string',
            'mission' => 'required|string',
            'id' => 'required|numeric'
        ]);

        // get table and update
        $update = DB::table('site_details')->updateOrInsert(
            ['id' => $request->id],
            [
                'description' => $request->description,
                'mission' => $request->mission
            ]
        );

        if ($update) {
            Session::flash('success', 'Details updated successfully');
            return redirect()->back();
        } else {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    }
}
