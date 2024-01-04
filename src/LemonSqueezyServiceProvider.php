<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy;

use Illuminate\Support\ServiceProvider;

class LemonSqueezyServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootPublishing();
    }
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/lemon-squeezy.php',
            'lemon-squeezy'
        );

    }

    protected function bootPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/lemon-squeezy.php' => $this->app->configPath('lemon-squeezy.php'),
            ], 'lemon-squeezy-config');

            $this->publishes([
                __DIR__ . '/../database/migrations' => $this->app->databasePath('migrations'),
            ], 'lemon-squeezy-migrations');

        }
    }
}
