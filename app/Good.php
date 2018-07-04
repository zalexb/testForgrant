<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    //
    public function discount(){
        return $this->hasMany('App\Discount','good_id','id');
    }
}
