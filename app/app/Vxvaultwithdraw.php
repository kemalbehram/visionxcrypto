<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vxvaultwithdraw extends Model
{
    protected $guarded = ['id'];

    
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->withDefault();
    }
}
