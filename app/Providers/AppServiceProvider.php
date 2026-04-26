<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //$this->app->usePublicPath(base_path('../public_html'));
        $this->app->singleton(\App\Services\PhotocardService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $navGroups = Cache::rememberForever('nav_category_groups', function () {
                return Category::where('is_active', true)
                    ->select('group')
                    ->groupBy('group')
                    ->orderByRaw("FIELD(`group`, 'Artist', 'Model', 'Brand Promoter', 'Content Creator', 'Director', 'Creative Crew')")
                    ->pluck('group');
            });

            $view->with('navGroups', $navGroups);
        });
    }
}
