<?php

namespace App\Providers;

use App\Category;
use App\ArticleCategory;

use App\Observers\CategoryObserver;
use App\Observers\ArticleCategoryObserver;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Category::observe(CategoryObserver::class);
        ArticleCategory::observe(ArticleCategoryObserver::class);

    }
}
