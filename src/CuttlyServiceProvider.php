<?php

namespace Technoyer\Cuttly;

use Illuminate\Support\ServiceProvider;
use Technoyer\Cuttly\CuttlyServer;

class CuttlyServiceProvider extends ServiceProvider
{
    /**
     * Register cuttly client.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cuttly', function () {
            return new CuttlyServer($this->app->make('config')->get('cuttly.api_key', ''));
        });

        $this->app->bind(CuttlyServer::class, 'cuttly');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ( ! $this->app->runningInConsole()) {
            return;
        }

        $configPath = $this->app->make('path.config');

        $this->publishes([__DIR__ . '/../config/cuttly.php' => $configPath.'/cuttly.php']);
    }

    /**
     * provides
     */
    public function provides()
    {
        return [
            CuttlyServer::class,
            'cuttly'
        ];
    }
}
