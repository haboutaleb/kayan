<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}