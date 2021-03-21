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
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'hearty5');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'hearty5');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/truefalse.php', 'truefalse');

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
            __DIR__.'/../config/truefalse.php' => config_path('truefalse.php'),
        ], 'truefalse.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/hearty5'),
        ], 'truefalse.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/hearty5'),
        ], 'truefalse.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/hearty5'),
        ], 'truefalse.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
