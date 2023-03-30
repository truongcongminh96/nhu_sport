@extends('frontend.master_dashboard')
@section('main')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
                <span></span> Giỏ hàng
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h4 class="heading-2 mb-10">Giỏ hàng của bạn</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                        <tr class="main-heading">
                            <th class="custome-checkbox start pl-30">

                            </th>
                            <th scope="col" colspan="2">Sản phẩm</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Màu sắc</th>
                            <th scope="col">Size</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng cộng</th>
                            <th scope="col" class="end">Xóa</th>
                        </tr>
                        </thead>
                        <tbody id="cartPage">
                        </tbody>
                    </table>
                </div>
                <div class="row mt-50">
                    <div class="col-lg-5">
                        <div class="p-40">
                            <h4 class="mb-10">Apply Coupon</h4>
                            <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</span></p>
                            <form action="#">
                                <div class="d-flex justify-content-between">
                                    <input class="font-medium mr-15 coupon" name="Coupon" placeholder="Enter Your Coupon">
                                    <button class="btn"><i class="fi-rs-label mr-10" disabled></i>Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="divider-2 mb-30"></div>
                        <div class="border p-md-4 cart-totals ml-30">
                            <div class="table-responsive">
                                <table class="table no-border">
                                    <tbody id="couponCalField">

                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('checkout') }}" class="btn mb-20 w-100">THANH TOÁN<i class="fi-rs-sign-out ml-15"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
