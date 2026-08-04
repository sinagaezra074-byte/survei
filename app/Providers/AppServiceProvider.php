<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Sidebar;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {

            $sidebars = Sidebar::where('status', 1)
                ->orderBy('urutan')
                ->get();

            $view->with('dynamicSidebars', $sidebars);
        });
    }
}
