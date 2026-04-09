<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register global helper functions
        require_once app_path('Helpers/DateHelper.php');

        // Register Blade directives for easier use in templates
        Blade::directive('formatDate', function ($expression) {
            return "<?php echo app('date-helper')->formatDate($expression); ?>";
        });

        Blade::directive('formatTime', function ($expression) {
            return "<?php echo app('date-helper')->formatTime($expression); ?>";
        });

        // Bind helper to container for easy access
        $this->app->singleton('date-helper', function () {
            return new \App\Helpers\DateHelper();
        });
    }
}
