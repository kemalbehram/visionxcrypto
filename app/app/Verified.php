<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verified extends Model
{
    protected $table = "verifieds";
    protected $guarded =[];
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
