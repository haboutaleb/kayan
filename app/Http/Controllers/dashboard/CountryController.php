<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\PARENT_DASHBOARD;
use App\Model\Country;
use App\Http\Requests\dashboard\CountryStore;
use App\Http\Requests\dashboard\CountryUpdate;
use App\Http\Controllers\IMAGE_CONTROLLER;

class CountryController extends PARENT_DASHBOARD
{
    public function __construct()
    {
        $this->data['squence_pages'][trans('dash.countries')] = route('countries');
        $this->mainRedirect = 'dashboard.country.';
    }


    public function index()
    {
        $this->data['countries'] = Country::all();
        return view($this->mainRedirect . 'index', $this->data);
    }

    public function create()
    {
        $this->data['squence_pages'][trans('dash.add_new_country')] = route('country_create');
        $this->data['latest_countries'] = Country::latest()->take(10)->get();
        return view($this->mainRedirect . 'create', $this->data);
    }

    public function store(CountryStore $request)
    {
        $country = new Country();
        $country->name_ar = $request->name_ar;
        $country->name_en = $request->name_en;
        $country->show_key = $request->show_key;
        $country->tel_key = $request->tel_key;
        $country->continent = $request->continent;
        if ($request->hasFile('image')) {
            $country->image = IMAGE_CONTROLLER::upload_single($request->image, 'storage/app/country');
        }

        $country->save();
        if ($request->back) {
            $forward_url = url('dashboard/country/create');
        } else {
            $forward_url = url('dashboard/country');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.added_successfully'));
    }

    public function edit($id = 0)
    {
        if (!Country::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $this->data['country'] = Country::find($id);
        $this->data['squence_pages'][trans('dash.edit_country')] = route('country_edit');
        $this->data['latest_countries'] = Country::latest()->take(10)->get();
        return view($this->mainRedirect . 'edit', $this->data);
    }

    public function update(CountryUpdate $request)
    {
        $country = Country::find($request->country_id);

        $country->name_ar = $request->name_ar;
        $country->name_en = $request->name_en;
        if ($request->show_key) {
            $country->show_key = $request->show_key;
        }
        if ($request->tel_key) {
            $country->tel_key = $request->tel_key;
        }
        if ($request->continent) {
            $country->continent = $request->continent;
        }
        $del_old_image = false;
        if ($request->image) {
            if ($country->image) {
                $del_old_image = true;
                $old_image_name = $country->image;
            }
            $country->image = IMAGE_CONTROLLER::upload_single($request->image, 'storage/app/country');
        }

        $country->update();
        if ($del_old_image) {
            IMAGE_CONTROLLER::delete_image($old_image_name, 'country');
        }
        if ($request->back) {
            $forward_url = url('dashboard/country/edit') . '/' . $country->id;
        } else {
            $forward_url = url('dashboard/country');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.edited_successfully'));
    }
    public function delete($id = 0)
    {
        if (!$country = Country::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $image = $country->image;
        if ($image) {
            IMAGE_CONTROLLER::delete_image($image, 'country');
        }
        $country->delete();
        return back()->with('class', 'alert alert-success')->with('message', trans('dash.deleted_successfully'));
    }
}
