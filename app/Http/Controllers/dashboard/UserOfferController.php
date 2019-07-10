<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\PARENT_DASHBOARD;
use App\Model\UserOffer;
use App\Model\Offer;
use App\User;
use App\Http\Requests\dashboard\CreateUserOfferRequest;
use App\Http\Requests\dashboard\EditUserOfferRequest;
use App\Http\Controllers\Controller;

class UserOfferController extends Controller
{
    //
    public function __construct()
    {
        $this->data['squence_pages'][trans('dash.useroffer')] = route('useroffer');
        $this->mainRedirect = 'dashboard.useroffers.';
    }

    public function index()
    {
        $this->data['useroffers'] = UserOffer::all();
        return view($this->mainRedirect . 'index', $this->data);
    }

    public function create()
    {
        $this->data['squence_pages'][trans('dash.add_new_useroffer')] = route('useroffer_create');
        $this->data['latest_useroffers'] = UserOffer::latest()->take(10)->get();
        $this->data['users'] = User::where('type','organization')->orwhere('type','user')->get();
        $this->data['offers'] = Offer::all();
        return view($this->mainRedirect . 'create', $this->data);
    }

    public function store(CreateUserOfferRequest $request)
    {
        $useroffer              = new UserOffer();
        $useroffer->price       = $request->price;
        $useroffer->details     = $request->details;
        $useroffer->offer_id    = $request->offer_id  ;
        $useroffer->from_user   = $request->from_user ;
        $useroffer->to_user     = $request->to_user   ;

        if($request->status){
            $useroffer->status      = $request->status ;
        }
        $useroffer->save();

        if ($request->back) {
            $forward_url = url('dashboard/useroffer/create');
        } else {
            $forward_url = url('dashboard/useroffer');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.added_successfully'));
    }

    public function edit($id = 0)
    {
        if (!UserOffer::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $this->data['useroffer'] = UserOffer::find($id);
        $this->data['users'] = User::where('type','organization')->orwhere('type','user')->get();
        $this->data['squence_pages'][trans('dash.edit_useroffer')] = route('useroffer_edit');
        $this->data['latest_useroffers'] = UserOffer::latest()->take(10)->get();
        return view($this->mainRedirect . 'edit', $this->data);
    }

    public function update(EditUserOfferRequest $request)
    {
        $useroffer            = UserOffer::find($request->useroffer_id);
        $useroffer->price       = $request->price;
        $useroffer->details     = $request->details;
        $useroffer->offer_id    = $request->offer_id  ;
        $useroffer->from_user   = $request->from_user  ;
        $useroffer->to_user     = $request->to_user  ;

        if($request->status){
        $useroffer->status      = $request->status ;
        }
        $useroffer->update();
        if ($request->back) {
            $forward_url = url('dashboard/useroffer/edit') . '/' . $useroffer->id;
        } else {
            $forward_url = url('dashboard/useroffer');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.edited_successfully'));
    }


    public function delete($id = 0)
    {
        if (!$useroffer = UserOffer::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $useroffer->delete();
        return back()->with('class', 'alert alert-success')->with('message', trans('dash.deleted_successfully'));
    }

}
