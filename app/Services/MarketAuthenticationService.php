<?php

namespace App\Services;

use App\Traits\AuthorizesMarketRequests;
use App\Traits\ConsumesExternalServices;
use App\Traits\InteractsWithMarketResponses;

class MarketAuthenticationService
{
    /**
     * The url from which send the requests
     * @var string
     */
    protected $baseUri;

    /**
     * The client_id to identify the client in the API
     * @var string
     */
    protected $clientId;

    /**
     * The client_secret to identify the client in the API
     * @var string
     */
    protected $clientSecret;

    /**
     * The client_id to identify the password client in the API
     * @var string
     */
    protected $passwordClientId;

    /**
     * The client_secret to identify the password client in the API
     * @var string
     */
    protected $passwordClientSecret;

    use ConsumesExternalServices, InteractsWithMarketResponses;

    public function __construct()
    {
        $this->baseUri = config('services.market.base_uri');
        $this->clientId = config('services.market.client_id');
        $this->clientSecret = config('services.market.client_secret');
        $this->passwordClientId = config('services.market.password_client_id');
        $this->passwordClientSecret = config('services.market.password_client_secret');
    }

    public function getClientCredentialsToken()
    {
        $formParams = [
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];

        $tokenData = $this->makeRequest('POST', 'oauth/token', [], $formParams);

        return "{$tokenData->token_type} {$tokenData->access_token}";
    }
}
