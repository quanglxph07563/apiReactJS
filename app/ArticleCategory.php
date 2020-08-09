<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    public $timestamps = false;
    protected $table = 'article_categories';
    protected $fillable = [
        'name_category'
    ];

    public function getTotalPostsAttribute()
    {
        return $this->hasMany('App\Posts','id_article_categories','id')->where('id_article_categories',$this->id)->count();    
    }
    public function posts()
    {
        return $this->hasMany('App\Posts','id_article_categories','id');
    }
}
