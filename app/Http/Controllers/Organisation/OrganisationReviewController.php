<?php

namespace App\Http\Controllers\Organisation;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Organisation;
use App\Review;
use App\Traits\ReviewTrait;
use Session;
use Auth;

class OrganisationReviewController extends Controller
{
    use ReviewTrait;

    protected $name;
    protected $uModel;

    public function __construct()
    {
        $this->middleware(
            'role:administrator|superadministrator|author'
        )->except(['create']);

        $this->name = 'organisations';
        $this->uModel = 'App\Organisation';
    }

    public function index($uuid)
    {
        $model = Organisation::getByUuid($uuid);

        return view('reviews.index', compact('model'));
    }

    public function create($uuid)
    {
        $model = Organisation::getByUuid($uuid);

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

            return redirect()->route('organisations.show', $uuid);
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
