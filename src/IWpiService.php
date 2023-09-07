<?php
namespace wpiservice\WpiService;

// Define an interface named IWpiService
interface IWpiService
{
    // This method is used to request performance data for a given URL using an API key.
    // Parameters:
    // - $url: The URL for which performance data is requested.
    // - $apiKey: The API key used for authentication.
    public function Performance($url, $apiKey);

    // This method is used to extract a specific performance metric from the provided data.
    // Parameters:
    // - $Data: The data containing performance metrics.
    // - $metricName (optional): The name of the specific metric to extract.
    //   If not provided, it may return a default metric or throw an exception.
    public function PerformanceMetric($Data, $metricName = null);
}

