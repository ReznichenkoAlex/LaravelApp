<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Services\ImageService\SaveImageInterface;
use App\Services\ImageService\SaveImageIntervention;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        $this->app->bind(SaveImageInterface::class, SaveImageIntervention::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.sidebar.category', function (\Illuminate\View\View $view) {
            return $view->with('categories', Category::getCacheCategories());
        });
        View::composer('layouts.footer', function (\Illuminate\View\View $view) {
            return $view->with('product', Product::query()->inRandomOrder()->first());
        });
    }
}
