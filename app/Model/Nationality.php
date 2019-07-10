<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $table = "nationality";
    protected $appends = ['imageurl', 'imageurlorg'];

    public function country()
    {
        return $this->belongsTo('App\Model\Country');
    }

    public function getImageurlAttribute()
    {
        if (!$this->attributes['image']) {
            return url('storage/app/category/default.png');
        }
        return url('storage/app/category/200x150') . '/' . $this->attributes['image'];
    }

    public function getImageurlorgAttribute()
    {
        if (!$this->attributes['image']) {
            return url('storage/app/category/default.png');
        }
        return url('storage/app/category/org') . '/' . $this->attributes['image'];
    }

}
