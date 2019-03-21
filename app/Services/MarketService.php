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
     * Publish a product on the API
     * @param  int $sellerId
     * @param  array $productData
     * @return sdtClass
     */
    public function publishProduct($sellerId, $productData)
    {
        return $this->makeRequest(
            'POST',
            "sellers/{$sellerId}/products",
            [],
            $productData,
            [],
            $hasFile = true
        );
    }

    /**
     * Associate a created product with an existing category
     * @param int $productId
     * @param int $categoryId
     */
    public function setProductCategory($productId, $categoryId)
    {
        return $this->makeRequest(
            'PUT',
            "products/{$productId}/categories/{$categoryId}"
        );
    }

    /**
     * Update a product on the API
     * @param  int $sellerId
     * @param  int $productId
     * @param  array $productData
     * @return sdtClass
     */
    public function updateProduct($sellerId, $productId, $productData)
    {
        $productData['_method'] = 'PUT';

        return $this->makeRequest(
            'POST',
            "sellers/{$sellerId}/products/{$productId}",
            [],
            $productData,
            [],
            $hasFile = isset($productData['picture'])
        );
    }

    /**
     * Allows to purchase a product
     * @param  int $productId
     * @param  int $buyerId
     * @param  int $quantity
     * @return sdtClass
     */
    public function purchaseProduct($productId, $buyerId, $quantity)
    {
        return $this->makeRequest(
            'POST',
            "products/{$productId}/buyers/{$buyerId}/transactions",
            [],
            ['quantity' => $quantity]
        );
    }

    /**
     * Obtains the list of categories from the API
     * @return stdClass
     */
    public function getCategories()
    {
        return $this->makeRequest('GET', 'categories');
    }

    /**
     * * Obtains a product from the API
     * @param  int $id
     * @return stdClass
     */
    public function getCategoryProducts($id)
    {
        return $this->makeRequest('GET', "categories/{$id}/products");
    }

    /**
     * * Retrieve a user information from the API
     * @return stdClass
     */
    public function getUserInformation()
    {
        return $this->makeRequest('GET', "users/me");
    }

    /**
     * Obtains a list of purchases
     * @param  int $buyerId
     * @return stdClass
     */
    public function getPurchases($buyerId)
    {
        return $this->makeRequest('GET', "buyers/{$buyerId}/products");
    }

    /**
     * Obtains a list of publications
     * @param  int $sellerId
     * @return stdClass
     */
    public function getPublications($sellerId)
    {
        return $this->makeRequest('GET', "sellers/{$sellerId}/products");
    }
}
