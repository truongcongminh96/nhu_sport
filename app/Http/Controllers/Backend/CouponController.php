<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function allCoupon()
    {
        $coupon = Coupon::latest()->get();
        return view('backend.coupon.coupon_all', compact('coupon'));
    }


    public function addCoupon()
    {
        return view('backend.coupon.coupon_add');
    }

    public function storeCoupon(Request $request)
    {

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupon')->with($notification);

    }

    public function editCoupon(int $id)
    {

        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.edit_coupon', compact('coupon'));

    }

    public function updateCoupon(Request $request)
    {

        $couponId = $request->id;
        Coupon::findOrFail($couponId)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.coupon')->with($notification);
    }

    public function deleteCoupon(int $id)
    {

        Coupon::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
