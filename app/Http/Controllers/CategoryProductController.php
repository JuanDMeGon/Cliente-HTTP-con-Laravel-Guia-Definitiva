<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    /**
     * Returns a page with product details from a given category
     * @return \Illuminate\Http\Response
     */
    public function showProducts($title, $id)
    {
        $products = $this->marketService->getCategoryProducts($id);

        return view('categories.products.show')->with([
            'products' => $products,
        ]);
    }
}
