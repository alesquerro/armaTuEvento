<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function photos(){
      return $this->hasMany('App\ProductPhotos');
    }

    public function event_types(){
      return $this->hasMany('App\EventType');
    }
}
