<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends Model
{
    protected $table = "notification";
    protected $appends = ['ago'];

    public function getAgoAttribute()
    {
        Carbon::setLocale('ar');
        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']))->diffForHumans();
    }
}
