# WpiService PHP Class

The `WpiService` class is a PHP library that allows you to check the performance of a website using the Google PageSpeed Insights API. This library provides a convenient way to analyze a website's performance metrics and retrieve specific performance data.

## Installation

To use this library in your PHP project, follow these steps:

1. Install Guzzle HTTP client, if you haven't already, using Composer:

   ```bash
   composer require guzzlehttp/guzzle
   ```

2. Install `WpiService` Package in your project.
  
   ```bash
   composer require wpiservice/wpi-service
   ```
### Create an Instance of `IWpiService` Interface

To utilize the `IWpiService` interface within your Laravel controller, you'll need to create an instance of it and inject the `WpiService` implementation of the interface into your `Controller`. Follow these steps:

1. Import the necessary classes at the top of your controller file:

```php
use wpiservice\WpiService\IWpiService;
use wpiservice\WpiService\WpiService;
```

2. Declare a protected property `$service` of type `IWpiService` Interface within your `Controller`:

```php
class Controller extends Controller
{
    protected IWpiService $service;

    // ...
}
```

3. Create a constructor in your controller to inject an instance of `WpiService` class into the `IWpiService` Interface property:

```php
public function __construct(WpiService $wpiService)
{
    $this->service = $wpiService;
}
```

With these steps, you have now created an instance of the `IWpiService` interface in your `Controller` and injected the `WpiService` class into it. This setup allows you to access the methods provided by the `IWpiService` interface using the `$this->service` property within your controller methods.

### Performance Analysis

You can use the `Performance` method to analyze the performance of a website. This method takes two parameters: the URL of the website to be analyzed and your Google PageSpeed API key for authentication and access to the API.

```php
$url = 'https://example.com';
$apiKey = 'your-api-key';

   $result = $this->service->Performance($url, $apiKey);

if (isset($result['error'])) {
    // Handle the error.
} else {
    // Use the performance data.
}
```

### Fetching Specific Performance Metrics

You can also fetch specific performance metrics from the Google PageSpeed Insights data using the `PerformanceMetric` method. This method takes two parameters: the performance data obtained from the API and the name of the specific performance metric to be retrieved.

```php
   $performanceData = $this->service->Performance($url, $apiKey);
$metricName = 'first-contentful-paint';

$metricData = $wpiService->PerformanceMetric($performanceData, $metricName);

if (isset($metricData['error'])) {
    // Handle the error.
} else {
    // Use the specific performance metric data.
}
```

Valid values for `$metricName` include:
- 'first-contentful-paint'
- 'largest-contentful-paint'
- 'total-blocking-time'
- 'cumulative-layout-shift'

## Error Handling

Both `Performance` and `PerformanceMetric` methods return an associative array containing performance data or an error message if the request or metric retrieval fails. You should check for the presence of the 'error' key in the returned data to handle errors gracefully.

## License

This library is licensed under the MIT License.

## Contribution

Contributions are welcome! If you'd like to contribute to this project, please open an issue or submit a pull request.


---

Feel free to customize this README to include your name, contact information, and any additional details specific to your project. Providing clear and comprehensive documentation will make it easier for others to use your PHP class.