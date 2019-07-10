<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = "bank_accounts";
    public function getImageurlAttribute()
    {
        if (!BankAccount::find($this->id)->image) {
            return url('storage/app/bank/default.png');
        }
        return url('storage/app/bank/200x150') . '/' . $this->attributes['image'];
    }
    public function getImageurlorgAttribute()
    {
        if (!BankAccount::find($this->id)->image) {
            return url('storage/app/bank/default.png');
        }
        return url('storage/app/bank/org') . '/' . $this->attributes['image'];
    }
}
