<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\IMAGE_CONTROLLER;
use App\Http\Controllers\PARENT_API;
use App\Http\Resources\SingleUser;
use App\User;
use App\Model\Token;
use App\Http\Requests\api\RegisterRequest;
use App\Http\Requests\api\OrganizationRegisterRequest;
use App\Http\Requests\api\LoginRequest;
use JWTAuth;

class AuthController extends PARENT_API
{

    public function signup(RegisterRequest $request){
        $user=new User();
        $user->mobile=$request->mobile;
        $user->full_name=$request->name;
        $user->email=$request->email;
        $user->type=$request->type;
        $user->password = bcrypt($request->password);
        if ($request->image) {
            $user->image = IMAGE_CONTROLLER::upload_single($request->image, 'storage/app/user');
        }
        //$user->city_id=$request->city_id;
        if ($request->latitude) {
            $user->latitude = $request->latitude;
        }
        if ($request->longitude) {
            $user->longitude = $request->longitude;
        }

        //$user->lang = "ar";
        $send_sms_activation_code=false;
        if (SETTING_VALUE('ACTIVE_AUTO_4_NORMAL_USER') == "true") {
            $user->active = "active";
            $user->code = null;
            $user->num_try_active = 0;
        } else {
            $user->active = "deactive";
            $user->code = mt_rand(100000, 999999);
            $send_sms_activation_code = true;
        }
        if ($send_sms_activation_code) {
            $sms_activation_code_msg = trans('app.sms_activation_code_msg', ['code' => $user->code], 'ar');
            SEND_SINGLE_SMS($user->mobile, $sms_activation_code_msg);
        }
        $user->save();
        $token = new Token();
        $token->user_id = $user->id;
        $token->fcm = $request->fcm_token;
        $token->device_type = $request->header('os');
        $token->jwt = JWTAuth::fromUser($user);
        $token->is_logged_in = 'true';
        $token->ip = $request->ip();
        $token->save();
        $this->data['data'] = new SingleUser($user);
        $this->data['status'] = "ok";
        $this->data['message'] = '';
        return response()->json($this->data, 200);

    }

    public function orgnizationSinUp(OrganizationRegisterRequest $request){
        $user            = new User();
        $user->mobile    = $request->mobile;
        $user->full_name = $request->name;
        $user->email     = $request->email;
        $user->type      = $request->type;
        $user->password  = bcrypt($request->password);
        if ($request->image) {
            $user->image = IMAGE_CONTROLLER::upload_single($request->image, 'storage/app/user');
        }

        if ($request->specialize_image) {
            $user->specialize_image = IMAGE_CONTROLLER::upload_single($request->specialize_image, 'storage/app/user/data');
        }

        $user->category_id         = $request->category_id;
        $user->linked_in           = $request->linked_in;
        $user->identitity_number   = $request->identitity_number;
        //$user->city_id=$request->city_id;
        if ($request->latitude) {
            $user->latitude = $request->latitude;
        }
        if ($request->longitude) {
            $user->longitude = $request->longitude;
        }
        if($request->description){
            $user->desc = $request->description;
        }
        //$user->lang = "ar";
        $send_sms_activation_code = false;
        if (SETTING_VALUE('ACTIVE_AUTO_4_NORMAL_USER') == "true") {
            $user->active = "active";
            $user->code   = null;
            $user->num_try_active = 0;
        } else {
            $user->active = "deactive";
            $user->code   = mt_rand(100000, 999999);
            $send_sms_activation_code = true;
        }
        if ($send_sms_activation_code) {
            $sms_activation_code_msg = trans('app.sms_activation_code_msg', ['code' => $user->code], 'ar');
            SEND_SINGLE_SMS($user->mobile, $sms_activation_code_msg);
        }
        $user->save();
        $token              = new Token();
        $token->user_id     = $user->id;
        $token->fcm         = $request->fcm_token;
        $token->device_type = $request->header('os');
        $token->jwt         = JWTAuth::fromUser($user);
        $token->is_logged_in= 'true';
        $token->ip          = $request->ip();
        $token->save();
        $this->data['data'] = new SingleUser($user);
        $this->data['status'] = "ok";
        $this->data['message'] = '';
        return response()->json($this->data, 200);
    }

    public function signin(LoginRequest $request){

        $perms['email'] = $request->email;
        $perms['password'] = $request->password;
        if (!$token = JWTAuth::attempt($perms)) {
            $this->data['data'] = '';
            $this->data['status'] = "fails";
            $this->data['message'] = trans('auth.failed_login');
            return response()->json($this->data, 203);
        }
        $logged_user = auth()->user();
        if ($request->latitude && $request->longitude) {
            $logged_user->latitude = $request->latitude;
            $logged_user->longitude = $request->longitude;
        }
        $logged_user->update();

        $logged_user_token = $logged_user->token;
        $logged_user_token->jwt = $token;
        $logged_user_token->is_logged_in = "true";
        // if ($request->fcm_token && $request->device_type) {
        $logged_user_token->fcm = $request->fcm_token;
        $logged_user_token->device_type = $request->header('os');
        //        }
        $logged_user_token->ip = $request->ip();
        $logged_user_token->update();
        $this->data['data'] = new SingleUser($logged_user);
        $this->data['status'] = "ok";
        $this->data['message'] = "";
        return response()->json($this->data, 200);
    }

    public function logout(){
        auth()->logout();
    }
}
