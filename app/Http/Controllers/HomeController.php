<?php

namespace App\Http\Controllers;

use App\OrganisationCategory;
use DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = OrganisationCategory::distinctCategoryNames();

        return view('home', compact('categories'));
    }

    public function about()
    {
        $details = DB::table('site_details')->first();

        return view('site.about', compact('details'));
    }
}
