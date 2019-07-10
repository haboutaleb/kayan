<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\PARENT_API;
use App\User;
use App\Http\Controllers\IMAGE_CONTROLLER;
use App\Model\Follow;
use App\Http\Resources\SingleUser;
use App\Http\Resources\AdvertisesCollection;

class UserControllerController extends PARENT_API
{
    public function profile($id)
    {
        // return userProfile Data
        // Following and follower Counter
        // Advertis Pagination (Such As Response On Home Page [Avertises data] )
        $user=User::find($id);
        if(is_null($user)){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = '';
            return response()->json($this->data, 405);
        }

        $this->data['data'] = new SingleUser($user);
        $this->data['ads']=new AdvertisesCollection($user->advertises()->paginate(15));
        $this->data['status'] = "ok";
        $this->data['message'] = '';
        return response()->json($this->data, 200);
    }

    public function update()
    {
        // Upadte User (every cell on if condition)
        // image - city_id - password
        //
    }

    public function toggle_follow($id)
    {
        // check if is_follow or not
        // if follow u will pass data to func _UnFollow else _DoFollow

        $is_follow=Follow::where('user_id',$this->user->id)->where('follower_id',$id)->first();
        if (is_null($is_follow)){
            $this->_DoFollow($id);
            $message=trans('app.follow_successful');
        }else{
            $this->_UnFollow($id);
            $message=trans('app.unfollow_successful');
        }
        $this->data['data'] = '';
        $this->data['status'] = "ok";
        $this->data['message'] = $message;
        return response()->json($this->data, 200);

    }

    public function _DoFollow($id)
    {
        $follow=new Follow();
        $follow->user_id=$this->user->id;
        $follow->follower_id=$id;
        $follow->save();
        return true;

    }

    public function _UnFollow($id)
    {
        $follow=Follow::where('user_id',$this->user->id)->where('follower_id',$id)->first();
        $follow->delete();
        return true;

    }
}
