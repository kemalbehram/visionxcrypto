<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Power extends Model
{

     use SoftDeletes;
    protected $guarded = [];
    protected $table = "powers";


     
    public function trx()
    {
        return $this->hasMany('App\Trx','id');
    }
}
