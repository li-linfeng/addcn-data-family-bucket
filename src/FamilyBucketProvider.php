<?php

namespace Bucket;

use Illuminate\Support\ServiceProvider;

class FamilyBucketProvider  extends  ServiceProvider
{

  /**
     * Register services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');


        if ($this->app->runningInConsole()) {
            $this->registerMigrations();

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'bucket-migrations');

            $this->publishes([
                __DIR__.'/../config/bucket.php' => config_path('bucket.php'),
            ], 'bucket-config');
        }

        $this->loadRoutesFrom(__DIR__.'/route.php');
    }

/**
     * Register Passport's migration files.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }


}