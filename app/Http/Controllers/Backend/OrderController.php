<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function pendingOrder(): Factory|View|Application
    {
        $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();
        return view('backend.orders.pending_orders', compact('orders'));
    }

    public function adminOrderDetails(int $orderId)
    {
        $order = Order::where('id', $orderId)->first();
        $orderItem = OrderItem::with('product')->where('order_id', $orderId)->orderBy('id', 'DESC')->get();

        return view('backend.orders.admin_order_details', compact('order', 'orderItem'));

    }

    public function pendingToConfirm(int $orderId)
    {
        Order::findOrFail($orderId)->update(['status' => 'confirm']);

        $notification = array(
            'message' => 'Xác nhận đơn hàng thành công',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.confirmed.order')->with($notification);
    }

    public function adminConfirmedOrder()
    {
        $orders = Order::where('status', 'confirm')->orderBy('id', 'DESC')->get();
        return view('backend.orders.confirmed_orders', compact('orders'));
    }

    public function confirmToDelete(int $orderId)
    {
        Order::findOrFail($orderId)->delete();
        OrderItem::where('order_id', $orderId)->delete();
        $notification = array(
            'message' => 'Xác nhận đơn hàng thành công',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.confirmed.order')->with($notification);
    }
}
