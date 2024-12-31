# Laravel PHP-FPM Prometheus Exporter

This project exposes a Prometheus metrics endpoint in your Laravel application, based on FPM's current state. 

It exposes 3 metrics:

1. Idle processes
2. Total processes
3. Active processes

This can be used in conjunction with [Prometheus Adapter](https://github.com/kubernetes-sigs/prometheus-adapter) to give you new metrics to scale your application up and down with Kubernetes.

# Config
Publish the config file via
`php artisan vendor:publish --tag=prometheus`
to customize your configuration.

# Prometheus Adapter Config

Given the following rule:

```yml
rules:
  default: false
  custom:
    - seriesQuery: 'phpfpm_active_processes{namespace!="",pod_name!=""}'
      resources:
        overrides:
          namespace:
            resource: namespace
          pod_name:
            resource: pod
      name:
        matches: "phpfpm_active_processes"
        as: "phpfpm_active_processes_utilization"
      metricsQuery: avg(phpfpm_active_processes{<<.LabelMatchers>>} / phpfpm_total_processes{<<.LabelMatchers>>}) by (<<.GroupBy>>)
```

And the following Kubernetes HPA

```yml
kind: HorizontalPodAutoscaler
apiVersion: autoscaling/v2
metadata:
  name: php-fpm-hpa
spec:
  scaleTargetRef:
    apiVersion: apps/v1
    kind: Deployment
    name: php-fpm
  # autoscale between 1 and 2 replicas
  minReplicas: 1
  maxReplicas: 2
  metrics:
  # use a "Pods" metric, which takes the average of the
  # given metric across all pods controlled by the autoscaling target
  - type: Pods
    pods:
      # use the metric that you used above: pods/http_requests
      metric:
        name: phpfpm_active_processes_utilization
      #Value: 500m: Targets 50% utilization
      target:
        type: Value
        averageValue: 500m
```

This will trigger a scale up when your average worker utilization hits 50%

# Full Example
Coming soon.

# Note

This project was heavily inspired by [hipages/php-fpm_exporter](https://github.com/hipages/php-fpm_exporter).