<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkoutStore(Request $request): View|Factory|Application
    {

        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->post_code;

        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['state_id'] = $request->state_id;
        $data['shipping_address'] = $request->shipping_address;
        $data['notes'] = $request->notes;
        $cartTotal = Cart::total();
        $carts = Cart::content();
        if ($request->payment_option == 'bank') {
            return view('frontend.payment.bank', compact('data', 'cartTotal', 'carts'));
        } else {
            return view('frontend.payment.cash', compact('data', 'cartTotal', 'carts'));
        }
    }

    public function cashOrder(Request $request): RedirectResponse
    {
        if (Session::has('coupon')) {
            $totalAmount = Session::get('coupon')['total_amount'];
        } else {
            $totalAmount = Cart::total();
        }

        $formatAmount = str_replace('.', '', $totalAmount);

        $orderId = Order::insertGetId([
            'user_id' => Auth::id() ?? NULL,
            'division_id' => $request->division_id ?? NULL,
            'district_id' => $request->district_id ?? NULL,
            'state_id' => $request->state_id ?? NULL,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => 'Cash On Delivery',
            'payment_method' => 'Cash On Delivery',

            'currency' => 'VND',
            'amount' => (int)$formatAmount,

            'invoice_no' => 'EOS' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),

        ]);

        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $orderId,
                'product_id' => $cart->id,
                'vendor_id' => $cart->options->vendor,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),

            ]);

        }

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        $notification = array(
            'message' => 'Đặt hàng thành công! Chúng tôi sẽ liên hệ cho bạn sớm!',
            'alert-type' => 'success'
        );
        return redirect()->route('home.index')->with($notification);
    }

    public function bankOrder(Request $request): RedirectResponse
    {
        if (Session::has('coupon')) {
            $totalAmount = Session::get('coupon')['total_amount'];
        } else {
            $totalAmount = Cart::total();
        }

        $formatAmount = str_replace('.', '', $totalAmount);

        $orderId = Order::insertGetId([
            'user_id' => Auth::id() ?? NULL,
            'division_id' => $request->division_id ?? NULL,
            'district_id' => $request->district_id ?? NULL,
            'state_id' => $request->state_id ?? NULL,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => 'Cash On Delivery',
            'payment_method' => 'Cash On Delivery',

            'currency' => 'VND',
            'amount' => (int)$formatAmount,

            'invoice_no' => 'EOS' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),

        ]);

        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $orderId,
                'product_id' => $cart->id,
                'vendor_id' => $cart->options->vendor,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),

            ]);

        }

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        $notification = array(
            'message' => 'Đặt hàng thành công! Chúng tôi sẽ liên hệ cho bạn sớm!',
            'alert-type' => 'success'
        );
        return redirect()->route('home.index')->with($notification);
    }
}
