<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * @param int $id
     * @param string $slug
     * @return Factory|View|Application
     */
    final public function productDetails(int $id, string $slug): Factory|View|Application
    {
        $product = Product::findOrFail($id);
        return view('frontend.product.product_details', compact('product'));
    }
}
