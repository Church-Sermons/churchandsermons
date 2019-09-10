<?php

namespace App\Http\Controllers\Sermon;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Sermon;
use App\Review;
use App\Traits\ReviewTrait;
use Session;
use Auth;

class SermonReviewController extends Controller
{
    use ReviewTrait;

    protected $name;
    protected $uModel;

    public function __construct()
    {
        $this->middleware(
            'role:administrator|superadministrator|author'
        )->except(['create']);

        $this->name = 'sermons';
        $this->uModel = 'App\Sermon';
    }

    public function index($uuid)
    {
        $model = Sermon::getByUuid($uuid);

        return view('reviews.index', compact('model'));
    }

    public function create($uuid)
    {
        $model = Sermon::getByUuid($uuid);

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

            return redirect()->route('sermons.show', $uuid);
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
