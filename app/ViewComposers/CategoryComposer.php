<?php

namespace App\ViewComposers;

use App\Models\Category;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class CategoryComposer
{
    public function compose(View $view): View
    {
        return $view->with(
            'categories',
            Cache::remember('categories', CarbonInterval::days(), function () {
                return Category::get();
            })
        );
    }
}