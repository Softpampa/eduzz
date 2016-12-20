<?php

namespace Softpampa\Eduzz;

use Illuminate\Support\ServiceProvider;

class EduzzServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->package('softpampa/eduzz');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app['eduzz'] = $this->app->share(function ($app) {
            return new Eduzz;
        });

        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Eduzz', 'Softpampa\Eduzz\Facades\Eduzz');
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('eduzz');
    }
}
