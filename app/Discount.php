<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    //
    protected $fillable = [
        'start',
        'end',
        'price',
        'good_id'
    ];
}
