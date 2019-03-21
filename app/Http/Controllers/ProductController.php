<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarketService;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth')->except(['showProduct']);

        parent::__construct($marketService);
    }

    /**
     * Returns a page with product details
     * @return \Illuminate\Http\Response
     */
    public function showProduct($title, $id)
    {
        $product = $this->marketService->getProduct($id);

        return view('products.show')->with([
            'product' => $product,
        ]);
    }

    /**
     * Purchase a product
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function purchaseProduct()
    {
        //
    }

    /**
     * Show the form to publish a product
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showPublishProductForm()
    {
        $categories = $this->marketService->getCategories();

        return view('products.publish')->with([
            'categories' => $categories,
        ]);
    }

    /**
     * Publish a product
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function publishProduct(Request $request)
    {
        $rules = [
            'title' => 'required',
            'details' => 'required',
            'stock' => 'required|min:1',
            'picture' => 'required|image',
            'category' => 'required',
        ];

        $productData = $this->validate($request, $rules);
        $productData['picture'] = fopen($request->picture->path(), 'r');

        $productData = $this->marketService->publishProduct($request->user()->service_id, $productData);

        $this->marketService->setProductCategory($productData->identifier, $request->category);

        return redirect()
            ->route('products.show',
                [
                    $productData->title,
                    $productData->identifier,
                ])
            ->with('success', ['Product created successfully']);
    }
}
