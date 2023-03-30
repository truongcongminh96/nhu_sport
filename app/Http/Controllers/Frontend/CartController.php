<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function addToCart(Request $request, int $id): JsonResponse
    {
        $product = Product::findOrFail($id);

        if ($product->discount_price === NULL) {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => (int)$product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ]
            ]);

        } else {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => (int)$product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ]
            ]);
        }
        return response()->json(['success' => 'Thêm vào giỏ hàng thành công']);
    }

    public function addMiniCart(): JsonResponse
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ));
    }

    public function removeMiniCart(string $rowId): JsonResponse
    {
        Cart::remove($rowId);
        return response()->json(['success' => 'Đã xóa sản phẩm']);
    }

    public function addToCartDetails(Request $request, $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL) {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);
        } else {
            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);
        }
        return response()->json(['success' => 'Thêm vào giỏ hàng thành công']);
    }

    public function myCart(): Factory|View|Application
    {
        return view('frontend.mycart.view_mycart');
    }

    public function getCartProduct(): JsonResponse
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ));
    }

    public function cartRemove(string $rowId): JsonResponse
    {
        Cart::remove($rowId);
        return response()->json(['success' => 'Đã xóa sản phẩm']);
    }

    public function cartDecrement(string $rowId): JsonResponse
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        return response()->json('Decrement');
    }

    public function cartIncrement(string $rowId): JsonResponse
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
        return response()->json('Increment');
    }


    public function checkoutCreate()
    {
        if (Cart::total() > 0) {
            $carts = Cart::content();
            $cartQty = Cart::count();
            $cartTotal = Cart::total();
            return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal'));
        }

        $notification = array(
            'message' => 'Shopping At list One Product',
            'alert-type' => 'error'
        );
        return redirect()->to('/')->with($notification);
    }

    public function couponCalculation(): JsonResponse
    {
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        } else {
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }
}
