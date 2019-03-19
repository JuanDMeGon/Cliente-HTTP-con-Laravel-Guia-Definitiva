<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Returns welcome pafe
     * @return \Illuminate\Http\Response
     */
    public function showWelcomePage()
    {
        $products = $this->marketService->getProducts();
        $categories = $this->marketService->getCategories();

        return view('welcome')->with([
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
