<?php
namespace wpiservice\WpiService;


interface IWpiService
{
    public function Performance($url, $apiKey);
    public function PerformanceMetric($Data, $metricName = null);
}
