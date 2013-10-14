<?php
namespace Microsite\Former;

use Illuminate\Support\ServiceProvider;

/**
 * Register the Former package with the Laravel framework
 */
class FormerServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->app->bind('former.framework', function($app) {
            return new Framework($app);
        });
    }
}
