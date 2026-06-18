<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['home', 'catalog.*', 'contact', 'pages.show'], function ($view): void {
            $siteSettings = Schema::hasTable('site_settings') ? SiteSetting::values() : [];
            $navigationPages = Schema::hasTable('pages')
                ? Page::published()->where('show_in_navigation', true)->orderBy('sort_order')->orderBy('title')->get()
                : collect();

            $view->with(compact('siteSettings', 'navigationPages'));
        });
    }
}
