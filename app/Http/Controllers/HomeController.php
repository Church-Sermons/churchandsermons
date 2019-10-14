<?php

namespace App\Http\Controllers;

use App\Events\ContactMessageSendingSuccessful;
use App\Http\Requests\StoreContactRequest;
use App\OrganisationCategory;
use App\SiteMessage;
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

        $message = new SiteMessage($request->all());
        // dd($message);

        if ($message->save()) {
            // store message and set event to send message to administrator
            // event(new ContactMessageSendingSuccessful($message));

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
