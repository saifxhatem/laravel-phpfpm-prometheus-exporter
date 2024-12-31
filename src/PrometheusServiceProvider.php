<?php

namespace Saifh\LaravelPhpFpmPrometheusExporter;

use Prometheus\Storage\Redis;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\InMemory;
use Prometheus\CollectorRegistry;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class PrometheusServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish config
        $this->publishes([
            __DIR__.'/../config/prometheus-exporter.php' => config_path('prometheus-exporter.php'),
        ], 'prometheus');
    
        // Merge config
        $this->mergeConfigFrom(
            __DIR__.'/../config/prometheus-exporter.php', 'prometheus'
        );

        // Load package routes
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }



    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //register a single instance of the registry
        $this->app->singleton(CollectorRegistry::class, function () {
            $registry = null;
            if (config('prometheus.memory_store') === 'redis') {
                $redisAdapter = new Redis([
                    'host'     => config('prometheus.redis_configuration.redis_host'),
                    'port'     => config('prometheus.redis_configuration.redis_port'),
                    'password' => config('prometheus.redis_configuration.redis_password'),
                    'user'     => config('prometheus.redis_configuration.redis_username'),
                    //why is this cast needed when the value is an int?
                    'database' => (int) config('prometheus.redis_configuration.redis_database'),
                ]);
                $registry = new CollectorRegistry($redisAdapter);
            } else {
                $registry = new CollectorRegistry(new InMemory());
            }
            return $registry;
        });
        //register a single instance of the text format
        $this->app->singleton(RenderTextFormat::class, function () {
            return new RenderTextFormat();
        });
    }

}