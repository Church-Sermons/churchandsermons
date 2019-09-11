<?php

namespace App\Http\Controllers;

use App\OrganisationCategory;
use Illuminate\Http\Request;

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
        return view('site.about');
    }
}
