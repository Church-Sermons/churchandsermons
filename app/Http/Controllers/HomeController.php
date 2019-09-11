<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\OrganisationCategory;
use DB;
use Session;
use Carbon\Carbon;

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

    public function contact()
    {
        return view('site.contact');
    }

    public function storeContactMessages(StoreContactRequest $request)
    {
        $validator = $request->validated();

        $message = DB::table('site_messages')->insert([
            [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        if ($message) {
            // store message and set event to send message to administrator
            Session::flash('success', 'Message sent successfully');

            return redirect()->back();
        } else {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    }
}
