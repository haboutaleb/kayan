<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use App\Model\City;
use App\Model\Advertise;
use App\Model\Follow;

class User extends Authenticatable
{
    // use Notifiable;

    protected $table = "user";

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->uuid = Str::uuid();
        });
    }
    public function token()
    {
        return $this->hasOne('App\Model\Token');
    }

    public function admin_group()
    {
        if ($this->attributes['administration_group_id'] != null) {
            return $this->belongsTo('App\Model\AdministrationGroup', 'administration_group_id');
        }
        return false;
    }

    public function getImageurlAttribute()
    {
        $image = User::where('id', $this->id)->first()->image;
        if (!$image) {
            return url('storage/app/user/default.png');
        }
        return url('storage/app/user/200x150') . '/' . $this->attributes['image'];
    }
    public function getImageurlorgAttribute()
    {
        $image = User::where('id', $this->id)->first()->image;
        if (!$image) {
            return url('storage/app/user/default.png');
        }
        return url('storage/app/user/org') . '/' . $this->attributes['image'];
    }

    public function notifications()
    {
        return $this->hasMany('App\Model\Notification');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

    public function advertises(){
        return $this->hasMany(Advertise::class,'user_id');
    }

    public function followers(){
       return $this->hasMany(Follow::class,'user_id');
    }

    public function offer()
    {
        return $this->hasMany('App\Model\Offer', 'user_id', 'id');
    }

    public function sent()
    {
        return $this->hasMany('App\Model\Message', 'from_user', 'id');
    }

    public function recived()
    {
        return $this->hasMany('App\Model\Message', 'to_user', 'id');
    }

    public function contact()
    {
        return $this->hasMany('App\Model\Contact', 'user_id', 'id');
    }
    
    public function profile()
    {
        return $this->hasMany('App\Model\Comment', 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'from_user', 'id');
    }
}
