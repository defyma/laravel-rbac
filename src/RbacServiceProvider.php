<?php

namespace defyma\LaraRbac;

use defyma\LaraRbac\Services\AuthServiceProvider;
use defyma\LaraRbac\Services\RouteServiceProvider;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\AdminLteServiceProvider as AdminLteServiceProvider;

/**
 * Class RbacServiceProvider
 *
 * @package defyma\LaraRbac
 *
 * @author Andrey Girnik <girnikandrey@gmail.com>
 */
class RbacServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register dependency packages
        $this->app->register(AdminLteServiceProvider::class);

        // Register internal services
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);

        // Register commands
        $this->commands(\defyma\LaraRbac\Commands\InstallCommand::class);
        $this->commands(\defyma\LaraRbac\Commands\DatabaseCommand::class);
        $this->commands(\defyma\LaraRbac\Commands\AdminCommand::class);
    }

    public function boot()
    {
        $this->loadViews();

        $this->publishViews();

        $this->publishConfig();

        $this->publishMigrations();

        $this->publishSeeds();
    }

    /**
     * Set directory to load views.
     *
     * @return void
     */
    private function loadViews(): void
    {
        $this->loadViewsFrom(base_path('resources/views/vendor/rbac'), 'rbac');
    }

    /**
     * Publish views.
     *
     * @return void
     */
    private function publishViews(): void
    {
        $this->publishes([
            $this->packagePath('resources/views') => base_path('resources/views/vendor/rbac'),
        ], 'views');
    }

    /**
     * Publish configs.
     *
     * @return void
     */
    private function publishConfig(): void
    {
        $configPath = $this->packagePath('config/rbac.php');

        $this->publishes([
            $configPath => config_path('rbac.php'),
        ], 'config');

        $this->mergeConfigFrom($configPath, 'rbac');
    }

    /**
     * Publish migrations.
     *
     * @return void
     */
    private function publishMigrations(): void
    {
        $this->publishes([
            $this->packagePath('database/migrations') => database_path('migrations'),
        ], 'migrations');
    }

    /**
     * Publish seeds.
     *
     * @return void
     */
    private function publishSeeds(): void
    {
        $this->publishes([
            $this->packagePath('database/seeds') => database_path('seeds'),
        ], 'seeds');
    }

    /**
     * Get package path.
     *
     * @param $path
     *
     * @return string
     */
    private function packagePath($path): string
    {
        return __DIR__."/../$path";
    }
}
