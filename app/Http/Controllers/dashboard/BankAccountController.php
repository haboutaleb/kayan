<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\PARENT_DASHBOARD;
use App\Model\BankAccount;
use Validator;
use App\Http\Controllers\IMAGE_CONTROLLER;

class BankAccountController extends PARENT_DASHBOARD
{
    public function __construct()
    {
        $this->data['squence_pages'][trans('dash.banks_accounts')] = route('bank_account');
    }

    public function index()
    {
        $this->data['banks'] = BankAccount::orderBy('id', 'desc')->get();
        return view('dashboard.bank_account.index', $this->data);
    }

    public function create()
    {
        $this->data['squence_pages'][trans('dash.add_new_bank_account')] = route('bank_account_create');
        $this->data['banks'] = BankAccount::orderBy('id', 'desc')->get();
        return view('dashboard.bank_account.create', $this->data);
    }

    public function store(Request $request)
    {
        $valid_data = [
            'bank_name' => $request->bank_name,
            'benif_name' => $request->benif_name,
            'account_number' => $request->account_number,
            'ipan_number' => $request->ipan_number,
            'image' => $request->image
        ];
        $valid_rules = [
            'bank_name' => 'required',
            'benif_name' => 'required',
            'account_number' => 'required',
            'ipan_number' => 'required',
            'image' => 'required'
        ];
        $validator = Validator::make($valid_data, $valid_rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $bank = new BankAccount();
        $bank->benif_name = $request->benif_name;
        $bank->account_number = $request->account_number;
        $bank->ipan_number = $request->ipan_number;
        $bank->bank_name = $request->bank_name;
        $bank->image = ImageController::upload_single($request->image, 'storage/app/bank');
        $bank->save();
        MK_REPORT('dashboard_create_bank_account', 'Create New Bank Account Name ' . $bank->bank_name, $bank);
        if ($request->back) {
            $forward_url = url('dashboard/bank_account/create');
        } else {
            $forward_url = url('dashboard/bank_account');
        }
        return redirect($forward_url)
            ->with('swal', trans('dash.date_updated_successfully'))
            ->with('icon', 'success')
            ->with('class', 'alert alert-success')
            ->with('message', trans('dash.added_successfully'));
    }

    public function edit($id = 0)
    {
        if (!BankAccount::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $this->data['squence_pages'][trans('dash.edit_bank_account')] = route('bank_account_edit');
        $this->data['banks'] = BankAccount::orderBy('id', 'desc')->get();
        $this->data['bank'] = BankAccount::find($id);
        return view('dashboard.bank_account.edit', $this->data);
    }

    public function update(Request $request)
    {

        $valid_data = [
            'bank_name' => $request->bank_name,
            'benif_name' => $request->benif_name,
            'account_number' => $request->account_number,
            'ipan_number' => $request->ipan_number,
            'bank_account_id' => $request->bank_account_id
        ];
        $valid_rules = [
            'bank_name' => 'required',
            'benif_name' => 'required',
            'account_number' => 'required',
            'ipan_number' => 'required',
            'bank_account_id' => 'required|exists:bank_account,id'
        ];
        $validator = Validator::make($valid_data, $valid_rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $bank = BankAccount::find($request->bank_account_id);
        MK_REPORT('dashboard_update_bank_account', 'Upadate Bank Account Name ' . $bank->bank_name, $bank);
        $bank->benif_name = $request->benif_name;
        $bank->account_number = $request->account_number;
        $bank->ipan_number = $request->ipan_number;
        $bank->bank_name = $request->bank_name;
        $del_old_image = false;
        if ($request->image) {
            if ($bank->image) {
                $del_old_image = true;
                $old_image_name = $bank->image;
            }
            $bank->image = ImageController::upload_single($request->image, 'storage/app/bank');
        }
        $bank->update();
        if ($del_old_image) {
            ImageController::delete_image($old_image_name, 'bank');
        }
        if ($request->back) {
            $forward_url = url('dashboard/bank_account/edit') . '/' . $bank->id;
        } else {
            $forward_url = url('dashboard/bank_account');
        }
        return redirect($forward_url)
            ->with('swal', trans('dash.date_updated_successfully'))
            ->with('icon', 'success')
            ->with('class', 'alert alert-success')
            ->with('message', trans('dash.edited_successfully'));
    }

    public function delete($id = 0)
    {
        if (!$bank = BankAccount::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $image = $bank->image;
        if ($image) {
            ImageController::delete_image($image, 'bank');
        }
        MK_REPORT('dashboard_delete_bank_account', 'Delete Bank Account Name ' . $bank->bank_name, $bank);
        $bank->delete();
        return back()->with('class', 'alert alert-success')->with('message', trans('dash.deleted_successfully'));
    }
}
