<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdministrationGroup extends Model
{
    protected $table = "administration_group";
    public function admins()
    {
        return $this->hasMany('App\User');
    }
}
