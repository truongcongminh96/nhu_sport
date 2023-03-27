<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, int $id): JsonResponse
    {
        $product = Product::findOrFail($id);

        if ($product->discount_price === NULL) {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => (int)$request->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ]
            ]);

            return response()->json(['success' => 'Thêm vào giỏ hàng thành công']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => (int)$request->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ]
            ]);
            return response()->json(['success' => 'Thêm vào giỏ hàng thành công']);
        }
    }
}
