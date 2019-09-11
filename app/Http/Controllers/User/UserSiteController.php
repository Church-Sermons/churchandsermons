<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserSiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:administrator|superadministrator');
    }

    public function siteAboutEdit()
    {
        return view('user.site.about');
    }
}
