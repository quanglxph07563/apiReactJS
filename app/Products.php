<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table ='products';
    protected $fillable=[
        'name_product',
        'images',
        'price',
        'sale',
        'amount',
        'detail',
        'view',
        'idCategory'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category','idCategory','id');
    }
}
