<?php

namespace Alive2212\LaravelReferralService;

use Illuminate\Support\ServiceProvider;

class LaravelReferralServiceServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // translations
        $this->loadTranslationsFrom(resource_path('lang/vendor/alive2212'),
            'laravel-referral-service');

        // migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // routes
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {

            // Publishing the configuration file.
            $this->publishes([
                __DIR__ . '/../config/laravel-referral-service.php' =>
                    $this->app->basePath() .
                    '/config/' .
                    'laravel-referral-service.php',
            ], 'laravel-referral-service.config');

            // Publishing the translation files.
            $this->publishes([
                __DIR__ . '/../resources/lang/' => resource_path('lang/vendor/alive2212'),
            ], 'laravel-referral-service.lang');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/alive2212'),
            ], 'laravel-referral-service.views');

            $this->publishes([
                __DIR__ . '/../public' => base_path('public'),
            ], 'laravel-referral-service.css');

        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-referral-service.php', 'laravel-referral-service');

        // Register the service the package provides.
        $this->app->singleton('laravel-referral-service', function ($app) {
            return new LaravelReferralService;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-referral-service'];
    }
}