<?php

namespace Trax\Lrs;

use Illuminate\Support\ServiceProvider;
use Trax\Lrs\BasicClients\BasicClientService;
use Trax\Auth\Stores\Accesses\AccessService;

class LrsServiceProvider extends ServiceProvider
{
    /**
     * List of commands.
     *
     * @var array
     */
    protected $commands = [
        \Trax\Lrs\Console\CreateAdminCommand::class,
        \Trax\Lrs\Console\DeleteAdminCommand::class,
        \Trax\Lrs\Console\ListAdminCommand::class,
        \Trax\Lrs\Console\UpdateAdminCommand::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Needed during the install.
        if ($this->app->runningInConsole()) {
            // Commands.
            $this->commands($this->commands);
            // Define migrations.
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }

        // Define routes.
        $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');

        // Load views.
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'trax-front-lrs');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Basic client service.
        $this->app->singleton(BasicClientService::class, function () {
            $accesses = $this->app->make(AccessService::class);
            return new BasicClientService($accesses);
        });
    }
}
