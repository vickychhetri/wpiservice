<?php
namespace wpiservice\WpiService;
use GuzzleHttp\Client;
class WpiService
{

  /**
   * Check the performance of Website
   *@params $url,GOOGLE_PAGESPEED_API_KEY
   */
  public function Performance($url, $apiKey)
  {
      $client = new Client();
      $response = $client->get("https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=$url&key=$apiKey");
  
      if ($response->getStatusCode() === 200) {
          $data = json_decode($response->getBody(), true);
          return $data;
      } else {
          return ['error' => 'Failed to retrieve data.'];// Handle the case where the response is not successful (e.g., not found or unauthorized).
       }
  }
  


  /**
   * If you want to fetch individual metric
   *@params $data,$metricName
   */
public function PerformanceMetric($Data, $metricName = null)
{
    if ($Data === null || !isset($Data['lighthouseResult']) || !isset($Data['lighthouseResult']['audits'])) {
        return response->json(['error' => 'The Data is missing or invalid']) ;
    }

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
            return ['error' => 'Invalid metric name'];
    }

    if (isset($Data['lighthouseResult']['audits'][$metricKey])) {
        return $Data['lighthouseResult']['audits'][$metricKey];
    } else {
        // Handle the case when the metric data is not found

        return response->json(['error' => $metricName . ' data not found in the response']) ;
    }
}

}