<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vxvault extends Model
{
    protected $guarded = ['id'];

    public function plan()
    {
        return $this->hasOne(Plan::class, 'id', 'plan_id')->withDefault();
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->withDefault();
    }
}
