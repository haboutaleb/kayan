<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\PARENT_DASHBOARD;
use App\Model\Review;
use App\User;
use App\Http\Requests\dashboard\CreateReviewRequest;
use App\Http\Requests\dashboard\EditReviewRequest;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->data['squence_pages'][trans('dash.review')] = route('review');
        $this->mainRedirect = 'dashboard.reviews.';
    }

    public function index()
    {
        $this->data['reviews'] = Review::all();
        return view($this->mainRedirect . 'index', $this->data);
    }

    public function create()
    {
        $this->data['squence_pages'][trans('dash.add_new_review')] = route('review_create');
        $this->data['latest_reviews'] = Review::latest()->take(10)->get();
        $this->data['users'] = User::where('type','organization')->orwhere('type','user')->get();
        return view($this->mainRedirect . 'create', $this->data);
    }

    public function store(CreateReviewRequest $request)
    {
        $review              = new Review();
        $review->user_id     = $request->user_id;
        $review->reviewer_id     = $request->reviewer_id;
        $review->review     = $request->review  ;
    
        $review->save();

        if ($request->back) {
            $forward_url = url('dashboard/review/create');
        } else {
            $forward_url = url('dashboard/review');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.added_successfully'));
    }

    public function edit($id = 0)
    {
        if (!Review::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $this->data['review'] = Review::find($id);
        $this->data['users'] = User::where('type','organization')->orwhere('type','user')->get();
        $this->data['squence_pages'][trans('dash.edit_review')] = route('review_edit');
        $this->data['latest_reviews'] = Review::latest()->take(10)->get();
        return view($this->mainRedirect . 'edit', $this->data);
    }

    public function update(EditReviewRequest $request)
    {
        $review = Review::find($request->review_id);
        $review->user_id     = $request->user_id;
        $review->reviewer_id      = $request->reviewer_id;
        $review->review     = $request->review  ;
   
        $review->update();
        if ($request->back) {
            $forward_url = url('dashboard/review/edit') . '/' . $review->id;
        } else {
            $forward_url = url('dashboard/review');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.edited_successfully'));
    }


    public function delete($id = 0)
    {
        if (!$review = Review::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $review->delete();
        return back()->with('class', 'alert alert-success')->with('message', trans('dash.deleted_successfully'));
    }

}
