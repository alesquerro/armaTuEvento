<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['purchase_date', 'event_date','user_id','total_amount','remainder','booking','state','payment_method_id','active','name','address_id'];
}
