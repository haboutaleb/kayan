<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = "country";
    protected $appends = ['imageurl', 'imageurlorg'];

    public function getImageurlAttribute()
    {
        if (!$this->attributes['image']) {
            return url('storage/app/country/default.png');
        }
        return url('storage/app/country/200x150') . '/' . $this->attributes['image'];
    }
    public function getImageurlorgAttribute()
    {
        if (!$this->attributes['image']) {
            return url('storage/app/country/default.png');
        }
        return url('storage/app/country/org') . '/' . $this->attributes['image'];
    }

    public function cities(){
        return $this->hasMany(City::class,'country_id');
    }
}
