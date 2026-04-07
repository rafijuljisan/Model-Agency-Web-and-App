<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class NavigationComposer
{
    public function compose(View $view): void
    {
        $navGroups = Cache::remember('nav_category_groups', 3600, function () {
            return Category::where('is_active', true)
                ->select('group')
                ->distinct()
                ->orderBy('group')
                ->pluck('group');
        });

        $view->with('navGroups', $navGroups);
    }
}