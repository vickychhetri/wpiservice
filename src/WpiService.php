<?php
namespace wpiservice\WpiService;
use GuzzleHttp\Client;
use wpiservice\WpiService\IWpiService;
class WpiService implements IWpiService
{

 /**
 * Check the performance of a website using the Google PageSpeed Insights API.
 *
 * This function takes two parameters, $url and $apiKey, and makes a request to the Google PageSpeed Insights API to analyze the performance of the specified website.
 *
 * @param string $url The URL of the website to be analyzed.
 * @param string $apiKey Your Google PageSpeed API key for authentication and access to the API.
 *
 * @return array An associative array containing performance data or an error message if the request fails.
 */
public function Performance($url, $apiKey)
{
    // Create a new HTTP client instance (assuming it's from a library like Guzzle).
    $client = new Client();
    
    // Construct the API URL by appending the provided $url and $apiKey as query parameters.
    $apiUrl = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=$url&key=$apiKey";
    
    // Send an HTTP GET request to the Google PageSpeed Insights API.
    $response = $client->get($apiUrl);

    // Check if the HTTP response status code is 200, indicating a successful request.
    if ($response->getStatusCode() === 200) {
        $data = json_decode($response->getBody(), true);
        return $data;
    } else {
     
        return ['error' => 'Failed to retrieve data.'];
    }

}


/**
 * Fetch a specific performance metric from the Google PageSpeed Insights data.
 *
 * This function takes two parameters: $Data, which is an associative array containing performance 
 * data obtained from the Google PageSpeed Insights API, and $metricName, which specifies the 
 * desired performance metric to be retrieved.
 *
 * @param array $Data An associative array containing performance data from the API.
 * @param string|null $metricName The name of the specific performance metric to be fetched.
 *  Valid values include 'first-contentful-paint', 'largest-contentful-paint', 
 * 'total-blocking-time', and 'cumulative-layout-shift'. 
 *
 * @return mixed An array containing the requested performance metric data 
 * or an error message if the metric is not found or if the input data is invalid.
 */
public function PerformanceMetric($Data, $metricName = null)
{
    // Check if the input $Data is null or lacks the expected structure.
    if ($Data === null || !isset($Data['lighthouseResult']) || !isset($Data['lighthouseResult']['audits'])) {
        // Return an error response indicating that the data is missing or invalid.
        return response->json(['error' => 'The data is missing or invalid']);
    }

    // Use a switch statement to map the provided $metricName to its corresponding metric key in the data.
    switch ($metricName) {
        case 'first-contentful-paint':
            $metricKey = 'first-contentful-paint';
            break;
        case 'largest-contentful-paint':
            $metricKey = 'largest-contentful-paint';
            break;
        case 'total-blocking-time':
            $metricKey = 'total-blocking-time';
            break;
        case 'cumulative-layout-shift':
            $metricKey = 'cumulative-layout-shift';
            break;
        default:
            // Handle the case where an invalid metric name is provided.
            return ['error' => 'Invalid metric name'];
    }

    // Check if the specified metric key exists in the data.
    if (isset($Data['lighthouseResult']['audits'][$metricKey])) {
        // Return the specific metric data if found in the response.
        return $Data['lighthouseResult']['audits'][$metricKey];
    } else {
        // Handle the case when the metric data is not found in the response.
        return response->json(['error' => $metricName . ' data not found in the response']);
    }
}


}


