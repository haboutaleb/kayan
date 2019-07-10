<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    public function profile()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');

    }

    public function user()
    {
        return $this->belongsTo('App\User', 'from_user', 'id');
    }
}
