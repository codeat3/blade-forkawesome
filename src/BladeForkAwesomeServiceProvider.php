<?php

declare(strict_types=1);

namespace Codeat3\BladeForkAwesome;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;

final class BladeForkAwesomeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->callAfterResolving(Factory::class, function (Factory $factory) {
            $factory->add('forkawesome', [
                'path' => __DIR__.'/../resources/svg',
                'prefix' => 'forkawesome',
            ]);
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-forkawesome'),
            ], 'blade-forkawesome');
        }
    }
}
