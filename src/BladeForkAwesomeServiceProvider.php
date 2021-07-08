<?php

declare(strict_types=1);

namespace Codeat3\BladeForkAwesome;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;

final class BladeForkAwesomeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-forkawesome', []);

            $factory->add('forkawesome', array_merge(['path' => __DIR__.'/../resources/svg'], $config));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/blade-forkawesome.php', 'blade-forkawesome');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-forkawesome'),
            ], 'blade-forkawesome');

            $this->publishes([
                __DIR__.'/../config/blade-forkawesome.php' => $this->app->configPath('blade-forkawesome.php'),
            ], 'blade-forkawesome-config');
        }
    }
}
