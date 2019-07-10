<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\PARENT_DASHBOARD;
use App\Model\Nationality;
use Validator;
use App\Model\Country;

class NationalitiesController extends PARENT_DASHBOARD
{
    public function index()
    {
        $this->data['nationalities'] = Nationality::all();
        return view('dashboard.nationality.index', $this->data);
    }

    public function create()
    {
        $this->data['latest_nationalities'] = Nationality::orderBy('id', 'desc')->take(10)->get();
        $this->data['countries'] = Country::all();
        return view('dashboard.nationality.create', $this->data);
    }

    public function store(Request $request)
    {
        $valid_data = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'country_id' => $request->country_id
        ];
        $valid_rules = [
            'name_ar' => 'required',
            'name_en' => 'required',
            'country_id' => 'required|numeric|exists:country,id'
        ];
        $validator = Validator::make($valid_data, $valid_rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $nationality = new Nationality();
        $nationality->name_ar = $request->name_ar;
        $nationality->name_en = $request->name_en;
        $nationality->country_id = $request->country_id;

        $nationality->save();
        if ($request->back) {
            $forward_url = url('dashboard/nationality/create');
        } else {
            $forward_url = url('dashboard/nationality');
        }
        return redirect($forward_url)
            ->with('swal', trans('dash.added_successfully'))
            ->with('icon', 'success')
            ->with('class', 'alert alert-success')
            ->with('message', trans('dash.added_successfully'));
    }

    public function edit($id = 0)
    {
        if (!$nationality = Nationality::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $this->data['latest_nationalities'] = Nationality::orderBy('id', 'desc')->take(10)->get();
        $this->data['nationality'] = $nationality;
        $this->data['countries'] = Country::all();
        return view('dashboard.nationality.edit', $this->data);
    }

    public function update(Request $request)
    {
        $valid_data = [
            'nationality_id' => $request->nationality_id,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'country_id' => $request->country_id
        ];
        $valid_rules = [
            'nationality_id' => 'required|exists:nationality,id',
            'name_ar' => 'required',
            'name_en' => 'required',
            'country_id' => 'required|numeric|exists:country,id'
        ];
        $validator = Validator::make($valid_data, $valid_rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $nationality = Nationality::find($request->nationality_id);
        $nationality->name_ar = $request->name_ar;
        $nationality->name_en = $request->name_en;
        $nationality->country_id = $request->country_id;

        $nationality->save();
        if ($request->back) {
            $forward_url = url('dashboard/nationality/edit') . '/' . $request->nationality_id;
        } else {
            $forward_url = url('dashboard/nationality');
        }
        return redirect($forward_url)
            ->with('swal', trans('dash.added_successfully'))
            ->with('icon', 'success')
            ->with('class', 'alert alert-success')
            ->with('message', trans('dash.added_successfully'));
    }

    public function delete($id = 0)
    {
        if (!$nationality = Nationality::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $nationality->delete();
        return back()
            ->with('swal', trans('dash.date_updated_successfully'))
            ->with('icon', 'success')
            ->with('class', 'alert alert-success')
            ->with('message', trans('dash.deleted_successfully'));
    }
}
