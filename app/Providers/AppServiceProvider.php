<?php

namespace App\Providers;

use App\Helpers\DateHelper;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register DateHelper as a singleton
        $this->app->singleton('date-helper', function () {
            return new DateHelper();
        });
    }

    public function boot(): void
    {
        Paginator::useTailwind();

        // Share cities with ALL views (cached to prevent N+1)
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            static $cities;
            if (!isset($cities)) {
                $cities = \App\Models\City::orderBy('name')->get();
            }
            $view->with('cities', $cities);
        });

        // Register Blade component for date formatting
        Blade::directive('formatDate', function ($expression) {
            return "<?php echo DateHelper::formatDate({$expression}); ?>";
        });

        Blade::directive('formatTime', function ($expression) {
            return "<?php echo DateHelper::formatTime({$expression}); ?>";
        });

        Blade::directive('formatShowDate', function ($expression) {
            return "<?php echo DateHelper::formatShowDate({$expression}); ?>";
        });

        Blade::directive('formatDateTime', function ($expression) {
            return "<?php echo DateHelper::formatDateTime({$expression}); ?>";
        });
    }
}
