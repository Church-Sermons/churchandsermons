<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Session;
use Auth;
use App\Organisation;

class ReviewController extends Controller
{
    public function __construct()
    {
        $except = ['create'];
        $this->middleware('auth')->except($except);
        $this->middleware('role:admin|superadmin|author')->except($except);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uuid)
    {
        $organisation = Organisation::where('uuid', $uuid)->first();

        return view('reviews.index')->withOrganisation($organisation);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uuid)
    {
        $organisation = Organisation::where('uuid', $uuid)->first();

        return view('reviews.create')->withOrganisation($organisation);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $uuid)
    {
        $validator = $this->validate($request, [
            'rating' => 'required|between:0,5',
            'message' => 'required'
        ]);

        $review = new Review($request->all());
        $review->user_id = Auth::user()->id;
        $review->uuid_link = $uuid;

        if ($review->save()) {
            Session::flash(
                'success',
                'Review saved. Thank you for submitting a review'
            );

            return redirect()->back();
        } else {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid, $id)
    {
        $review = Review::findOrFail($id);

        return view('reviews.show')->withReview($review);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid, $id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id != Auth::user()->id) {
            Session::flash(
                'error',
                'You are not authorized to update this review'
            );
        }

        $validator = $this->validate($request, [
            'rating' => 'required|between:0,10',
            'message' => 'required',
            'uuid_link' => 'required|numeric'
        ]);

        $review->user_id = Auth::user()->id;
        $review->rating = $request->rating;
        $review->message = $request->review_message;
        $review->uuid_link = $uuid;

        if ($review->save()) {
            Session::flash('success', 'Review Edited');

            return redirect()->back();
        } else {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid, $id)
    {
        $review = Review::findOrFail($id);

        // if($review->user_id != Auth::user()->id){
        //     Session::flash('error', 'You are not authorized to update this review');
        // }

        if ($review->delete()) {
            Session::flash('success', 'Review deleted');

            return redirect()->back();
        } else {
            Session::flash('danger', 'Review failed to delete');

            return redirect()->back();
        }
    }
}
