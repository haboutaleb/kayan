<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\PARENT_DASHBOARD;
use App\Model\City;
use App\Model\Country;
use Validator;

class CityController extends PARENT_DASHBOARD
{
    public function __construct()
    {
        $this->data['squence_pages'][trans('dash.cities')] = route('cities');
    }

    public function index()
    {
        $this->data['cities'] = City::with('country')->get();
        return view('dashboard.city.index', $this->data);
    }

    public function create()
    {
        $this->data['squence_pages'][trans('dash.add_new_city')] = route('city_create');
        $this->data['latest_cities'] = City::with('country')->orderBy('id', 'desc')->take(10)->get();
        $this->data['countries'] = Country::all();
        return view('dashboard.city.create', $this->data);
    }

    public function store(Request $request)
    {
        $city_data = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'geo_lat' => $request->geo_lat,
            'geo_lng' => $request->geo_lng,
            'country_id' => $request->country_id
        ];
        $city_rules = [
            'name_ar' => 'required',
            'name_en' => 'required',
            'geo_lat' => 'required',
            'geo_lng' => 'required',
            'country_id' => 'required|exists:country,id'
        ];
        $validator = Validator::make($city_data, $city_rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $city = new City();
        $city->name_ar = $request->name_ar;
        $city->name_en = $request->name_en;
        $city->country_id = $request->country_id;
        $city->latitude = $request->geo_lat;
        $city->longitude = $request->geo_lng;
        if ($request->zip_code) {
            $city->zip_code = $request->zip_code;
        }

        $city->save();
        // MK_REPORT('dashboard_create_city', 'Create New City  ' . $city->name_ar, $city);
        if ($request->back) {
            $forward_url = url('dashboard/city/create');
        } else {
            $forward_url = url('dashboard/city');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.added_successfully'));
    }

    public function edit($id = 0)
    {
        if (!City::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $this->data['city'] = City::find($id);
        $this->data['squence_pages'][trans('dash.edit_city')] = route('city_edit');
        $this->data['latest_cities'] = City::with('country')->orderBy('id', 'desc')->take(10)->get();
        $this->data['countries'] = Country::all();
        return view('dashboard.city.edit', $this->data);
    }

    public function update(Request $request)
    {
        $city_data = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id
        ];
        $city_rules = [
            'name_ar' => 'required',
            'name_en' => 'required',
            'city_id' => 'required|exists:city,id'
        ];
        $validator = Validator::make($city_data, $city_rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $city = City::find($request->city_id);
        // MK_REPORT('dashboard_update_city', 'Update City ' . $city->name_ar, $city);
        $city->name_ar = $request->name_ar;
        $city->name_en = $request->name_en;
        $city->country_id = $request->country_id;
        if ($request->geo_lat) {
            $city->latitude = $request->geo_lat;
        }
        if ($request->geo_lng) {
            $city->longitude = $request->geo_lng;
        }
        if ($request->zip_code) {
            $city->zip_code = $request->zip_code;
        }
        $city->update();
        if ($request->back) {
            $forward_url = url('dashboard/city/edit') . '/' . $city->id;
        } else {
            $forward_url = url('dashboard/city');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.edited_successfully'));
    }

    public function delete($id)
    {
        if (!$city = City::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        // MK_REPORT('dashboard_delete_bank_account', 'Delete Bank Account Name ' . $bank->bank_name, $bank);
        $city->delete();
        return back()->with('class', 'alert alert-success')->with('message', trans('dash.deleted_successfully'));
    }
}
