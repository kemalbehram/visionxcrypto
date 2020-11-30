<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtualCard extends Model
{
    protected $table = "virtual_cards";

    protected $fillable = [
        'user_id', 'name', 'pan', 'masked_pan', 'city', 'state', 'address', 'cvv', 'expiration', 'type', 'currency', 'country', 'amount', 'status', 'card_id'
    ];
}
