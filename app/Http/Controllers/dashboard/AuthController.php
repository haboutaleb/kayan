<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\PARENT_DASHBOARD;
use Auth;
use Validator;
use App\Http\Controllers\ImageController;
use Hash;
use App\Model\AdministrationGroup;

class AuthController extends PARENT_DASHBOARD
{
    protected $mainRedirect = 'dashboard.auth.';

    public function login()
    {
        return view($this->mainRedirect . 'login');
    }


    public function login_post(Request $request)
    {
        $user_data = [
            'identify' => $request->identify,
            'password' => $request->password,
        ];

        $user_rules = [
            'identify' => 'required',
            'password' => 'required'
        ];
        $validator = Validator::make($user_data, $user_rules);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $identify = filter_var($request->identify, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        $remember = $request->remember;
        if (!Auth::attempt([$identify => $request->identify, 'password' => $request->password], $remember, 'administration_group_id' != null)) {
            return back()
                ->with('message', trans('dash.logged_in_faild_data'))
                ->with('class', 'alert alert-danger');
        }
        // MK_REPORT('dashboard_auth_signin', 'Logged in successfully', '');
        return redirect('/dashboard')
            ->with('message', trans('dash.logged_in_successfully'))
            ->with('class', 'alert alert-success');
    }

    public function logout()
    {
        Auth::logout();
        // MK_REPORT('dashboard_auth_signout', 'Logged out successfully', '');
        return redirect('dashboard/login')
            ->with('message', trans('dash.logged_out_successfully'))
            ->with('class', 'alert alert-success');
    }

    public function profile()
    {
        $this->data['page_header'] = "dashboard.theme.profile_header";
        $this->data['cities'] = \App\Model\City::select('id', 'name_' . $this->locale . ' as name')->get();
        $this->data['group_admins'] = AdministrationGroup::with(['admins' => function ($query) {
            $query->where('administration_group_id', '!=', null);
        }])->get();
        return view('dashboard.auth.profile', $this->data);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $old_user_data = $user;
        if ($request->email) {
            $user->email = $request->email;
        }
        if ($request->mobile) {
            $user->mobile = $request->mobile;
        }
        if ($request->full_name) {
            $user->full_name = $request->full_name;
        }
        if ($request->address) {
            $user->address = $request->address;
        }
        if ($request->city) {
            $user->city_id = $request->city;
        }

        if ($request->has('image')) {
            ImageController::delete_image($user->image, 'user');
            $image_name = ImageController::upload_single($request->image, 'storage/app/user');
            $user->image = $image_name;
        }

        $user->update();
        // MK_REPORT('user_update_profile', 'update profile', $old_user_data);
        return back()->with('message', trans('updated_success'))->with('class', 'alert alert-success');
    }

    public function change_password()
    {
        return view('dashboard.auth.change_password');
    }

    public function update_password(Request $request)
    {
        $password_data = [
            'old_password' => $request->old_password,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation
        ];

        $password_rules = [
            'old_password' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ];


        $validator = Validator::make($password_data, $password_rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();
        if (Hash::check($request->old_password, $user->getAuthPassword())) {
            $user->password = Hash::make($request->password);
            $old_data = $user->password;
            $user->update();
            // MK_REPORT('dashboard_auth_change_password', 'Change Password', $old_data);
            return back()->with('message', 'تم تغير كلمة المرور بنجاح')
                ->with('class', 'alert alert-success');
        } else {
            return back()->with('message', 'كلمة المرور القديمه خاطئه ،،، من فضلك اعد المحاوله')
                ->with('class', 'alert alert-danger');
        }
    }
}
