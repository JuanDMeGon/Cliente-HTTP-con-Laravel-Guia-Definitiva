<?php

namespace App\Services;

use App\Traits\ConsumesExternalServices;

class MarketService
{
    use ConsumesExternalServices;

    /**
     * Resolves the elements to send when authorazing the request
     * @param  array &$queryParams
     * @param  array &$formParams
     * @param  array &$headers
     * @return void
     */
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        //
    }

    /**
     * Decode correspondingly the response
     * @param  array $response
     * @return stdClass
     */
    public function decodeResponse($response)
    {
        //
    }

    /**
     * Resolve if the request to the service failed
     * @param  array $response
     * @return void
     */
    public function checkIfErrorResponse($response)
    {
        //
    }
}
