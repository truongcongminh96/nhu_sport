<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkoutStore(Request $request): View|Factory|string|Application
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

        if ($request->payment_option == 'bank') {
            return view('frontend.payment.bank', compact('data', 'cartTotal'));
        } else {
            return view('frontend.payment.cash', compact('data', 'cartTotal'));
        }
    }
}
