<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $table = 'smss';
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
