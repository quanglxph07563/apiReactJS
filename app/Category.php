<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = [
        'name_category',
        'images',
        'description'
    ];

    public function getTotalProductsAttribute()
    {
        return $this->hasMany('App\Products','idCategory','id')->where('idCategory',$this->id)->count();    
    }

    public function products()
    {
        return $this->hasMany('App\Products','idCategory','id');
    }
}
