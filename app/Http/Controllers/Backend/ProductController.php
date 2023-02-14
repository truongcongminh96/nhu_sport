<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function allProduct(): Factory|View|Application
    {
        $products = Product::latest()->get();
        return view('backend.product.product_all', compact('products'));
    }

    /**
     * @return Factory|View|Application
     */
    public function addProduct(): Factory|View|Application
    {
        return view('backend.product.product_add');
    }
}
