<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\PARENT_DASHBOARD;
use App\Model\Offer;
use App\Model\Category;
use App\User;
use App\Http\Requests\dashboard\CreateOfferRequest;
use App\Http\Requests\dashboard\EditOfferRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class OfferController extends PARENT_DASHBOARD
{
    //
    public function __construct()
    {
        $this->data['squence_pages'][trans('dash.offer')] = route('offer');
        $this->mainRedirect = 'dashboard.offers.';
    }

    public function index()
    {
        $this->data['offers'] = Offer::all();
        return view($this->mainRedirect . 'index', $this->data);
    }

    public function create()
    {
        $this->data['squence_pages'][trans('dash.add_new_offer')] = route('offer_create');
        $this->data['latest_offers'] = Offer::latest()->take(10)->get();
        $this->data['users'] = User::where('type','organization')->orwhere('type','user')->get();
        $this->data['categories'] = Category::all();

        return view($this->mainRedirect . 'create', $this->data);
    }

    public function store(CreateOfferRequest $request)
    {

        $offer              = new Offer();
        $offer->from        = $request->from ;
        $offer->to          = $request->to;
        $offer->type        = $request->type;
        $offer->gender      = $request->gender;
        $offer->note        = $request->note;
        $offer->user_id     = $request->user_id;
        $offer->category_id = $request->category_id;
        $offer->save();

        if ($request->back) {
            $forward_url = url('dashboard/offer/create');
        } else {
            $forward_url = url('dashboard/offer');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.added_successfully'));
    }

    public function edit($id = 0)
    {
        if (!Offer::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $this->data['offer'] = Offer::find($id);
        $this->data['users'] = User::where('type','organization')->orwhere('type','user')->get();
        $this->data['categories'] = Category::all();
        $this->data['squence_pages'][trans('dash.edit_offer')] = route('offer_edit');
        $this->data['latest_offer'] = Offer::latest()->take(10)->get();
        return view($this->mainRedirect . 'edit', $this->data);
    }

    public function update(EditOfferRequest $request)
    {
        $offer = Offer::find($request->offer_id);

        $offer->from        = $request->from;
        $offer->to          = $request->to;
        $offer->type        = $request->type;
        $offer->gender      = $request->gender;
        $offer->note        = $request->note;
        $offer->user_id     = $request->user_id;
        $offer->category_id = $request->category_id;


        $offer->update();

        if ($request->back) {
            $forward_url = url('dashboard/offer/edit') . '/' . $offer->id;
        } else {
            $forward_url = url('dashboard/offer');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.edited_successfully'));
    }


    public function delete($id = 0)
    {
        if (!$offer = Offer::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }

        $offer->delete();
        return back()->with('class', 'alert alert-success')->with('message', trans('dash.deleted_successfully'));
    }
}
