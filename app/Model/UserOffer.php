<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserOffer extends Model
{
    //

    public function creator()
    {
        return $this->belongsTo('App\User', 'from_user', 'id');
    }

    public function provider()
    {
        return $this->belongsTo('App\user', 'to_user', 'id');
    }

    public function offer()
    {
        return $this->belongsTo('App\Model\Offer', 'offer_id', 'id');
    }
}
