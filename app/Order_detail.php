<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $table ='order_detail';
    
    protected $fillable=[
        'id_product',
        'amount',
        'id_order'
    ];
    public function products()
    {
        return $this->belongsTo('App\Products','id_product','id');
    }
}
