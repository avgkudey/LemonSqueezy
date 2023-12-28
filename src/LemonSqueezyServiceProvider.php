<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy;

use Illuminate\Support\ServiceProvider;

class LemonSqueezyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/lemon-squeezy.php',
            'lemon-squeezy'
        );

    }

    public function boot(): void
    {
        $this->bootPublishing();
    }

    protected function bootPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/lemon-squeezy.php' => $this->app->configPath('lemon-squeezy.php'),
            ], 'lemon-squeezy-config');
        }
    }
}
