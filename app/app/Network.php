<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Network extends Model
{

     use SoftDeletes;
    protected $guarded = [];
    protected $table = "networks";


     
    public function trx()
    {
        return $this->hasMany('App\Trx','id');
    }
}
