<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Session;
use Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:administrator|superadministrator')->except(['store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uuid)
    {
        $reviews = Review::where('uuid_link', $uuid)->orderBy('id', 'desc')->paginate(10);

        return view('reviews.index')->withReviews($reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($uuid)
    {
        return view('reviews.create');
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
            'review_message' => 'required',
        ]);

        $review = new Review();
        $review->rating = $request->rating;
        $review->message = $request->review_message;
        $review->user_id = Auth::user()->id;
        $review->uuid_link = $uuid;

        if($review->save()){
            Session::flash('success', 'Review saved. Thank you for submitting a review');

            return redirect()->back();

        }else{

            return redirect()->back()->withErrors($validator)->withInput();
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
        $review = Review::where('id', $id)->first();

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

        if($review->user_id != Auth::user()->id){
            Session::flash('error', 'You are not authorized to update this review');
        }

        $validator = $this->validate($request, [
            'rating' => 'required|between:0,10',
            'review_message' => 'sometimes|required',
            'uuid_link' => 'required|numeric'
        ]);

        $review->user_id = Auth::user()->id;
        $review->rating = $request->rating;
        $review->message = $request->review_message;
        $review->uuid_link = $uuid;

        if($review->save()){
            Session::flash('success', 'Review Edited');

            return redirect()->back();

        }else{

            return redirect()->back()->withErrors($validator)->withInput();
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

        if($review->delete()){
            Session::flash('success', 'Review deleted');

            return redirect()->back();

        }else{

            Session::flash('error', 'Review failed to delete');

            return redirect()->back();
        }
    }
}
