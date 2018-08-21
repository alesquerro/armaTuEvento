<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	 protected $fillable = [
	 	'name', 
	 	'mail', 
	 	'cover', 
	 	'phone', 
	 	'capacity', 
	 	'description', 
	 	'product_type_id', 
	 	'minimum_resrevation',
	 	'price', 
	 	'price_type',
	 	// 'address_id', 
	 	// 'company_id', 
	 	// 'type',
	 	// 'active',

    ];

    public function photos(){
      return $this->hasMany('App\ProductPhotos');
    }

    public function event_types(){
      return $this->hasMany('App\EventType');
    }
}
