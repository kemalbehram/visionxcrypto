<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    protected $table = "password";
    protected $fillable=["user_id", "reason"];
}
