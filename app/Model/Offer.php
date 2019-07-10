<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Offer extends Model
{
    //
    protected $table='offers';

    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'category_id', 'id');
    }

    public function userOffer()
    {
        return $this->hasMany('App\Model\UserOffer', 'offer_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
