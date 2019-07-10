<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table = "messages";
    
    public function sender()
    {
        return $this->belongsTo('App\User', 'from_user','id');
    }

    public function recvier()
    {
        return $this->belongsTo('App\User', 'to_user','id');
    }


}
