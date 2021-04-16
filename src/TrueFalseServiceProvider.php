<?php

namespace Hearty5\TrueFalse;

use Illuminate\Support\ServiceProvider;

class TrueFalseServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'hearty5');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        // Publishing assets.
        $this->publishes([__DIR__ . '/assets' => public_path('vendor/truefalse'),], 'public');
        $this->publishes([ __DIR__ . '/views' => resource_path('views'),], 'public');
        $this->publishes([__DIR__ . '/assets/js/components' => resource_path('js/components'),], 'public');
        $this->publishes([__DIR__ . '/controllers' => app_path('http/controllers'),], 'public');
        $this->publishes([__DIR__ . '/models' => app_path('Models'),], 'public');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/truefalse.php', 'truefalse');

        // Register the service the package provides.
        $this->app->singleton('truefalse', function ($app) {
            return new TrueFalse;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['truefalse'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/truefalse.php' => config_path('truefalse.php'),
        ], 'truefalse.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/hearty5'),
        ], 'truefalse.views');*/


        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/hearty5'),
        ], 'truefalse.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
