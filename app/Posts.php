<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'images',
        'title',
        'detail',
        'id_article_categories'
    ];

    public function articleCategory()
    {
        return $this->belongsTo('App\ArticleCategory','id_article_categories','id');
    }
}
