<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Profile;
use App\Review;
use App\Traits\ReviewTrait;
use Session;
use Auth;

class ProfileReviewController extends Controller
{
    use ReviewTrait;

    protected $name;
    protected $uModel;

    public function __construct()
    {
        $except = ['create'];
        $this->middleware('auth')->except($except);
        $this->middleware('role:admin|superadmin|author')->except($except);

        $this->name = 'profiles';
        $this->uModel = 'App\Profile';
    }

    public function index($uuid)
    {
        $model = Profile::getByUuid($uuid);

        return view('reviews.index', compact('model'))->withName($this->name);
    }

    public function create($uuid)
    {
        $model = Profile::getByUuid($uuid);

        return view('reviews.create', compact('model'))->withName($this->name);
    }

    public function store(StoreReviewRequest $request, $uuid)
    {
        $response = $this->storeReviews($uuid, $request, $this->uModel);

        if ($response['review']->save()) {
            Session::flash(
                'success',
                'Review Saved. Thank you for your feedback'
            );

            return redirect()->route('profiles.show', $uuid);
        } else {
            return redirect()
                ->back()
                ->withErrors($response['validator'])
                ->withInput();
        }
    }

    public function destroy($uuid, $id)
    {
        $review = Review::findOrFail($id);

        if (Auth::check() && Auth::user()->isTribrid($review)) {
            if ($review->delete()) {
                Session::flash('success', 'Review deleted');
                return redirect()->back();
            } else {
                Session::flash('danger', 'Review failed to delete');

                return redirect()->back();
            }
        } else {
            Session::flash(
                'Unauthorized',
                'You are not authorized to delete this review'
            );
            return redirect()->back();
        }
    }
}
