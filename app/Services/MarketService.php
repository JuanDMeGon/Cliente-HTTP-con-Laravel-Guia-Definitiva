<?php

namespace App\Services;

use App\Traits\AuthorizesMarketRequests;
use App\Traits\ConsumesExternalServices;
use App\Traits\InteractsWithMarketResponses;

class MarketService
{
    use ConsumesExternalServices, AuthorizesMarketRequests, InteractsWithMarketResponses;

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
     * Obtains the list of products from the API
     * @return stdClass
     */
    public function getProducts()
    {
        return $this->makeRequest('GET', 'products');
    }

    /**
     * * Obtains a product from the API
     * @param  int $id
     * @return stdClass
     */
    public function getProduct($id)
    {
        return $this->makeRequest('GET', "products/{$id}");
    }

    /**
     * Obtains the list of categories from the API
     * @return stdClass
     */
    public function getCategories()
    {
        return $this->makeRequest('GET', 'categories');
    }
}
