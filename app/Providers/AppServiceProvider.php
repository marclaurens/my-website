<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\MenuItem;
use App\Models\Setting;

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
        View::composer('*', function ($view) {
            if (Schema::hasTable('menu_items')) {
                $menuItems = MenuItem::with('page')->orderBy('order', 'asc')->get();
                $view->with('headerMenuItems', $menuItems);
            } else {
                $view->with('headerMenuItems', collect());
            }

            if (Schema::hasTable('settings')) {
                $settings = Setting::pluck('value', 'key')->all();
                $view->with('globalSettings', $settings);
            } else {
                $view->with('globalSettings', []);
            }
        });
    }
}