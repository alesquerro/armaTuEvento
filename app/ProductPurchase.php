<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Purchase;
use App\Product;

class ProductPurchase extends Model
{

    protected $fillable = ['price','product_id','name','purchase_id','description','active'];

    public function purchase(){
      return $this->belongsTo(Purchase::class);
    }
    public function product(){
      return $this->belongsTo(Product::class);
    }
}
