<?php

namespace App\Services;

use App\Traits\AuthorizesMarketRequests;
use App\Traits\ConsumesExternalServices;
use App\Traits\InteractsWithMarketResponses;

class MarketAuthenticationService
{
    use ConsumesExternalServices, InteractsWithMarketResponses;

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

    public function __construct()
    {
        $this->baseUri = config('services.market.base_uri');
        $this->clientId = config('services.market.client_id');
        $this->clientSecret = config('services.market.client_secret');
        $this->passwordClientId = config('services.market.password_client_id');
        $this->passwordClientSecret = config('services.market.password_client_secret');
    }
}
