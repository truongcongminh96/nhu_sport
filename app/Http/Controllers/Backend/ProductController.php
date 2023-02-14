<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    final public function allProduct(): Factory|View|Application
    {
        $products = Product::latest()->get();
        return view('backend.product.product_all', compact('products'));
    }

    /**
     * @return Factory|View|Application
     */
    final public function addProduct(): Factory|View|Application
    {
        $activeVendor = User::where(['status' => User::STATUS_ACTIVE, 'role' => User::ROLE_VENDOR])->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.product.product_add', compact('brands', 'categories', 'activeVendor'));
    }
}
