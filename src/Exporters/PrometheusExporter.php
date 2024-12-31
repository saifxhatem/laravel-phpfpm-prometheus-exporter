<?php

namespace Saifh\LaravelPhpFpmPrometheusExporter\Exporters;

use Prometheus\RenderTextFormat;
use Prometheus\CollectorRegistry;
use Saifh\LaravelPhpFpmPrometheusExporter\Constants\PhpFpmConstants;

class PrometheusExporter
{
    public static function exportMetrics(CollectorRegistry $registry, RenderTextFormat $renderer) {
        $fpm_status = fpm_get_status();
        // get the 3 core metrics that we can use to determine if we should trigger scale up
        $active_processes = $fpm_status['active-processes'];
        $idle_processes = $fpm_status['idle-processes'];
        $total_processes = $fpm_status['total-processes'];
                
        // Define the metrics
        $metrics = [
            'active_processes' => ['type' => 'gauge', 'help' => 'The number of active processes.'],
            'idle_processes' => ['type' => 'gauge', 'help' => 'The number of idle processes.'],
            'total_processes' => ['type' => 'gauge', 'help' => 'The number of idle + active processes.'],
        ];
        
        // Register metrics
        foreach ($metrics as $name => $config) {
            $registry->getOrRegisterGauge('phpfpm', $name, $config['help']);
        }
        
        $registry->getGauge('phpfpm', PhpFpmConstants::PHPFPM_ACTIVE_PROCESSES)->set($active_processes);
        $registry->getGauge('phpfpm', PhpFpmConstants::PHPFPM_IDLE_PROCESSES)->set($idle_processes);
        $registry->getGauge('phpfpm', PhpFpmConstants::PHPFPM_TOTAL_PROCESSES)->set($total_processes);
        
        header('Content-type: ' . RenderTextFormat::MIME_TYPE);
        return $renderer->render($registry->getMetricFamilySamples());
    }
}