<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:author|administrator|superadministrator');
    }

    public function index()
    {
        return view('user.main.index');
    }
}
