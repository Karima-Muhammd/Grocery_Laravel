<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['product_name','product_price','product_quantity','total_price','img','user_id','order_id'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
