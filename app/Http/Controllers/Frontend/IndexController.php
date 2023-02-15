<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MultipleImage;
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
        $color = $product->product_color;
        $productColor = explode(',', $color);
        $size = $product->product_size;
        $productSize = explode(',', $size);
        $multipleImage = MultipleImage::where('product_id', $id)->get();

        $relatedProduct = Product::where('category_id', $product->category_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(4)->get();

        return view('frontend.product.product_details', compact('product', 'productColor', 'productSize', 'multipleImage', 'relatedProduct'));
    }
}
