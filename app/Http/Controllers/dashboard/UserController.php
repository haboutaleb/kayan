<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\IMAGE_CONTROLLER;
use App\User;
use App\Model\Category;
use App\Model\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\PARENT_DASHBOARD;

class UserController extends PARENT_DASHBOARD
{
    public function __construct()
    {
        $this->data['squence_pages'][trans('dash.users')] = route('user');
        $this->mainRedirect = 'dashboard.users.';
    }

    public function index()
    {
        $this->data['users'] = User::where('type','organization')->orwhere('type','user')->get();
        return view($this->mainRedirect . 'index', $this->data);
    }

    public function create()
    {
        $this->data['squence_pages'][trans('dash.add_new_user')] = route('user_create');
        $this->data['latest_users'] = User::where('type','organization')->orwhere('type','user')->latest()->take(10)->get();
        $this->data['categories'] = Category::all();

        return view($this->mainRedirect . 'create', $this->data);
    }

    public function store(CreateUserRequest $request)
    {
        $user                    = new User();
        $user->email             = $request->email;
        $user->mobile            = $request->mobile;
        $user->type              = $request->type;
        $user->identitity_number = $request->identitity_number;
        $user->full_name         = $request->full_name;
        $user->password          = bcrypt($request->password);
        $user->gender            = $request->gender;


        if($request->image) {
            $user->image = IMAGE_CONTROLLER::upload_single($request->image, 'storage/app/user');
        }

        if($request->latitude){
            $user->latitude          = $request->latitude;
        }

        if($request->longitude){
            $user->longitude         = $request->longitude;
        }

        if($request->lang){
            $user->lang              = $request->lang;
        }

        if($request->active){
            $user->active            = $request->active;
        }
        if($request->code){
            $user->code              = $request->code;
        }
        if($request->num_try_active){
            $user->num_try_active    = $request->num_try_active;
        }
        if($user->banned){
            $user->banned            = $request->banned;
        }
        if($user->ban_reason){
            $user->ban_reason        = $request->ban_reason;
        }
        if($user->online){
            $user->online            = $request->online;
        }
        if($request->available){
            $user->available         = $request->available;
        }
        if($request->wallet){
            $user->wallet            = $request->wallet;
        }
        if($user->address){
            $user->address           = $request->address;
        }
        if($user->bref){
            $user->bref              = $request->bref;
        }
    
        $user->uuid              = $request->uuid;
        $user->city_id           = $request->city_id;
        $user->nationality_id    = $request->nationality_id;
        $user->save();

        if ($request->back) {
            $forward_url = url('dashboard/user/create');
        } else {
            $forward_url = url('dashboard/user');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.added_successfully'));
    }

    public function edit($id = 0)
    {
        if (!User::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $this->data['user'] = User::find($id);
    
        $this->data['categories'] = Category::all();
        $this->data['squence_pages'][trans('dash.edit_user')] = route('user_edit');
        $this->data['latest_user'] = User::latest()->take(10)->get();
        return view($this->mainRedirect . 'edit', $this->data);
    }

    public function update(EditUserRequest $request)
    {
        $user = User::find($request->user_id);

        $user->email             = $request->email;
        $user->mobile            = $request->mobile;
        $user->type              = $request->type;
        $user->identitity_number = $request->identitity_number;
        $user->full_name         = $request->full_name;
        $user->password          = bcrypt($request->password);
        $user->gender            = $request->gender;
        $user->date_of_birth     = $request->date_of_birth;
        $del_old_image = false;
        if($request->image) {
            if($user->image){
                $del_old_image = true;
                $old_image_name = $user->image;
            }
            $user->image = IMAGE_CONTROLLER::upload_single($request->image, 'storage/app/user');
        }
        if($request->latitude){
            $user->latitude          = $request->latitude;
        }
        if($request->longitude){
            $user->longitude         = $request->longitude;
        }
        if($request->lang){
            $user->lang              = $request->lang;
        }
        if($request->active){
            $user->active            = $request->active;
        }
        if($request->code){
            $user->code              = $request->code;
        }
        if($request->num_try_active){
            $user->num_try_active    = $request->num_try_active;
        }
        if($user->banned){
            $user->banned            = $request->banned;
        }
        if($user->ban_reason){
            $user->ban_reason        = $request->ban_reason;
        }
        if($user->online){
            $user->online            = $request->online;
        }
        if($request->available){
            $user->available         = $request->available;
        }
        if($request->wallet){
            $user->wallet            = $request->wallet;
        }
        if($user->address){
            $user->address           = $request->address;
        }
        if($user->bref){
            $user->bref              = $request->bref;
        }
        if($user->extras){
            $user->extras            = $request->extras;
        }
        $user->uuid              = $request->uuid;
        $user->city_id           = $request->city_id;
        $user->nationality_id    = $request->nationality_id;

        $user->update();
        if ($del_old_image) {
            IMAGE_CONTROLLER::delete_image($old_image_name, 'ustorage/app/user');
        }
        if ($request->back) {
            $forward_url = url('dashboard/user/edit') . '/' . $user->id;
        } else {
            $forward_url = url('dashboard/user');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.edited_successfully'));
    }


    public function delete($id = 0)
    {
        if (!$user = User::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }

        $user->delete();
        return back()->with('class', 'alert alert-success')->with('message', trans('dash.deleted_successfully'));
    }
}
