<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table ='orders';
    protected $fillable=[
        'id_user',
        'total_price',
        'address'
    ];
    public function orderDetail()
    {
        return $this->hasMany('App\Order_detail','id_order','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','id_user','id');
    }
}
