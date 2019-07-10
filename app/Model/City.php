<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "city";
    protected $appends = ['imageurl', 'imageurlorg'];

    public function getImageurlAttribute()
    {
        if (!$this->attributes['image']) {
            return url('storage/app/city/default.png');
        }
        return url('storage/app/city/200x150') . '/' . $this->attributes['image'];
    }
    public function getImageurlorgAttribute()
    {
        if (!$this->attributes['image']) {
            return url('storage/app/city/default.png');
        }
        return url('storage/app/city/org') . '/' . $this->attributes['image'];
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
}
