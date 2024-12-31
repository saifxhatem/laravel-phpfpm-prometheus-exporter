<?php

namespace Saifh\LaravelPhpFpmPrometheusExporter\Constants;

class PhpFpmConstants
{
    // Metrics constants
    public const PHPFPM_ACCEPTED_CONNECTIONS = 'accepted_connections';
    public const PHPFPM_ACTIVE_PROCESSES = 'active_processes';
    public const PHPFPM_IDLE_PROCESSES = 'idle_processes';
    public const PHPFPM_LISTEN_QUEUE = 'listen_queue';
    public const PHPFPM_LISTEN_QUEUE_LENGTH = 'listen_queue_length';
    public const PHPFPM_MAX_ACTIVE_PROCESSES = 'max_active_processes';
    public const PHPFPM_MAX_CHILDREN_REACHED = 'max_children_reached';
    public const PHPFPM_MAX_LISTEN_QUEUE = 'max_listen_queue';
    public const PHPFPM_PROCESS_LAST_REQUEST_CPU = 'process_last_request_cpu';
    public const PHPFPM_PROCESS_LAST_REQUEST_MEMORY = 'process_last_request_memory';
    public const PHPFPM_PROCESS_REQUEST_DURATION = 'process_request_duration';
    public const PHPFPM_PROCESS_REQUESTS = 'process_requests';
    public const PHPFPM_PROCESS_STATE = 'process_state';
    public const PHPFPM_SCRAPE_FAILURES = 'scrape_failures';
    public const PHPFPM_SLOW_REQUESTS = 'slow_requests';
    public const PHPFPM_START_SINCE = 'start_since';
    public const PHPFPM_TOTAL_PROCESSES = 'total_processes';
    public const PHPFPM_UP = 'up';
}