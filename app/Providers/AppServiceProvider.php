<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\MenuItem;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Schema::hasTable('menu_items')) {
                $items = MenuItem::with('page')->orderBy('order', 'asc')->get();

                if (!auth()->check()) {
                    $items = $items
                        ->reject(fn ($i) => $i->page && $i->page->is_admin_only)
                        ->values();
                }

                $view->with('headerMenuItems', MenuItem::buildTree($items));
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