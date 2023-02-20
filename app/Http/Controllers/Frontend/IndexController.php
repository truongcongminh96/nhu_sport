<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultipleImage;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    final public function index(): Factory|View|Application
    {
        $hotDeals = Product::where('hot_deals', 1)->where('discount_price', '!=', NULL)->orderBy('id', 'DESC')->limit(3)->get();
        $specialOffer = Product::where('special_offer', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $featured = Product::where('featured', 1)->where('discount_price', '!=', NULL)->orderBy('id', 'DESC')->limit(3)->get();
        $specialDeals = Product::where('special_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();

        return view('frontend.index', compact('hotDeals', 'specialOffer', 'featured', 'specialDeals'));
    }

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

    final public function brandDetails(int $id): Factory|View|Application
    {
        $brand = Brand::findOrfail($id);
        $brandProduct = Product::where(['brand_id' => $brand->id])->get();

        return view('frontend.brand.brand_details', compact('brand', 'brandProduct'));
    }

    final public function listBrandAll(): Factory|View|Application
    {
        $brands = Brand::get();
        return view('frontend.brand.list_brand_all', compact('brands'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @param string $slug
     * @return Factory|View|Application
     */
    final public function catWiseProduct(Request $request, int $id, string $slug): Factory|View|Application
    {
        $products = Product::where('status', 1)->where('category_id', $id)->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $breadCategory = Category::where('id', $id)->first();

        return view('frontend.product.category_view', compact('products', 'categories', 'breadCategory'));
    }
}
