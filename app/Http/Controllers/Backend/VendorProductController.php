<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductController extends Controller
{
    final public function vendorAllProduct(): Factory|View|Application
    {
        $id = Auth::user()->id;
        $products = Product::where(['vendor_id' => $id])->latest()->get();
        return view('vendor.backend.product.vendor_product_all', compact('products'));
    }
}
