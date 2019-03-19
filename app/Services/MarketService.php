<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class MarketService
{
    use ConsumesExternalServices;

    /**
     * The url from which send the requests
     * @var string
     */
    protected $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.market.base_uri');
    }

    /**
     * Resolves the elements to send when authorazing the request
     * @param  array &$queryParams
     * @param  array &$formParams
     * @param  array &$headers
     * @return void
     */
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $accessToken = $this->resolveAccessToken();

        $header['Authorization'] = $accessToken;
    }

    /**
     * Decode correspondingly the response
     * @param  array $response
     * @return stdClass
     */
    public function decodeResponse($response)
    {
        $decodedResponse = json_decode($response);

        return $decodedResponse->data ?? $decodedResponse;
    }

    /**
     * Resolve if the request to the service failed
     * @param  array $response
     * @return void
     */
    public function checkIfErrorResponse($response)
    {
        if (isset($response->error)) {
            throw new \Exception("Something failed: {$response->error}");
        }
    }

    public function resolveAccessToken()
    {
        return 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImZmMDU0NGMyYjcwOTk2ZTEyOGE4OGNmYzFmM2FmMTFhZmYwN2Q2NDEyY2U3ZjdhYTU0OGZhYTY4NjIyYzAyN2UxZThiZmExY2YxNDc3Y2YzIn0.eyJhdWQiOiIyIiwianRpIjoiZmYwNTQ0YzJiNzA5OTZlMTI4YTg4Y2ZjMWYzYWYxMWFmZjA3ZDY0MTJjZTdmN2FhNTQ4ZmFhNjg2MjJjMDI3ZTFlOGJmYTFjZjE0NzdjZjMiLCJpYXQiOjE1NTMwMjgzMDYsIm5iZiI6MTU1MzAyODMwNiwiZXhwIjoxNTg0NjUwNzA2LCJzdWIiOiIxMDAxIiwic2NvcGVzIjpbInB1cmNoYXNlLXByb2R1Y3QiLCJtYW5hZ2UtcHJvZHVjdHMiLCJtYW5hZ2UtYWNjb3VudCIsInJlYWQtZ2VuZXJhbCJdfQ.FNjgEPGVy1huz2EacI2YUlpjs7rcpnLP7tkML1Jh-kfidtIcQ01ehj1daXrhbFC9TwQuujYidCMCKpGoXpxpYMDYMAnS7G4rGCi9b47Ws0WhzOrRHcpfdEvoSHhpxPJf6Iy831SABeaRQgOW487cMYsLavrWoTFnvDtzNqtEJXDSTh8ndWPXzVX4UwH1CejKN-g2gk8HnYDjrY1Yi6tUF9gSSLZC4zClGwyU72Ix69fNFZzI12Ok6kQJFHJjVk3e37nywji42c8ooDXmJxpBkxlO5f1J0tZ12Wan94FaTnwrN2SjrbG8zrtGrs45vBXSpe08kPWmuyOyDP60lN3AEy__MO8vohwfAt0Gn--knLwXB6uJOQDB1rq29gndJFSITt336rwW-SR_f4zWLTypTyPnMZBUIMnW3UjhPRGvAQ3W6hZjOB16zvXUNk9xZV7iDsczkufQlq-cnfQ8x3we3hNMAgaEGW1BHPXz2CJ2FFDyEMrMJ60k04-Q7dsOwrfbvygCz7Mqh-53pM5qkv6FrAjymwdsNnsnBjjGIIwXo6NzP6LRmgerAQALqD9t7M1auS5Re94me9Nscp3MXSVDowT44zh0Pza_SadQ4gNXSYZoEAspt4-P9cHL8G6Pd3AmgoZCHtz0KjVYW-dvRsZr5lgP-CJ4lWZtm8JIJKBoN50';
    }
}
