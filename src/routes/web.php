<?php

use Prometheus\RenderTextFormat;
use Prometheus\CollectorRegistry;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Saifh\LaravelPhpFpmPrometheusExporter\Exporters\PrometheusExporter;

Route::get(Config::get('prometheus.metrics_endpoint'), function () {
    $registry = app(CollectorRegistry::class);
    $formatter = app(RenderTextFormat::class);
    return PrometheusExporter::exportMetrics($registry, $formatter);
});