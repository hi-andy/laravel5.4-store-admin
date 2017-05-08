<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Tools\MD5Hasher;

class MD5HashServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('hash', function() { return new MD5Hasher(); });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('hash');
    }
}
