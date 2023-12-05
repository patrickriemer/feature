<?php

namespace PatrickRiemer\Feature;

use Illuminate\Support\ServiceProvider;

class FeatureServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('feature', function ($app) {
            return new Feature();
        });

        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'feature');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('feature.php'),
            ], 'config');

            if (! class_exists('CreateFeaturesTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_features_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_features_table.php'),
                ], 'migrations');

                sleep(1);

                $this->publishes([
                    __DIR__ . '/../database/migrations/create_feature_usages_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_feature_usages_table.php'),
                ], 'migrations');
            }
        }
    }
}