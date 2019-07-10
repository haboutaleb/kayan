<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function reviwer()
    {
        return $this->belongsTo('App\User', 'reviewer_id', 'id');
    }
}
