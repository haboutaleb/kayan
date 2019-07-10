<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $appends = ['imageurl', 'imageurlorg'];

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
        return url('storage/app/country/org') . '/' . $this->attributes['image'];
    }

    public function users()
    {
        return $this->hasMany('App\Model\User', 'category_id', 'id');
    }

    public function offers()
    {
        return $this->hasMany('App\Model\Offer', 'category_id', 'id');
    }


    
}
