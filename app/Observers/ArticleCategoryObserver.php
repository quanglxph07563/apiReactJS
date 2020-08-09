<?php

namespace App\Observers;

use App\ArticleCategory;

class ArticleCategoryObserver
{
    /**
     * Handle the article category "created" event.
     *
     * @param  \App\ArticleCategory  $articleCategory
     * @return void
     */
    public function created(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Handle the article category "updated" event.
     *
     * @param  \App\ArticleCategory  $articleCategory
     * @return void
     */
    public function updated(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Handle the article category "deleted" event.
     *
     * @param  \App\ArticleCategory  $articleCategory
     * @return void
     */
    public function deleted(ArticleCategory $articleCategory)
    {
        $articleCategory->posts()->delete();
    }

    /**
     * Handle the article category "restored" event.
     *
     * @param  \App\ArticleCategory  $articleCategory
     * @return void
     */
    public function restored(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Handle the article category "force deleted" event.
     *
     * @param  \App\ArticleCategory  $articleCategory
     * @return void
     */
    public function forceDeleted(ArticleCategory $articleCategory)
    {
        //
    }
}
