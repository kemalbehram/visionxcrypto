<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Internet extends Model
{

     use SoftDeletes;
    protected $guarded = [];
    protected $table = "internets";


     
    public function trx()
    {
        return $this->hasMany('App\Trx','id');
    }
}
