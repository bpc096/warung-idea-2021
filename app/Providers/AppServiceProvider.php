<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // TODO: Uncomment in deployment mode (Cpanel Server)
        // $this->app->bind('path.public', function() {
        //   return '/home/warungid/public_html/';
        // });
    }
}
