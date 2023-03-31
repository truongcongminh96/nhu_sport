@extends('frontend.master_dashboard')
@section('main')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
                <span></span> Thanh toán khi nhận hàng
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h3 class="heading-2 mb-10">Thanh toán chuyển khoản</h3>
                <div class="d-flex justify-content-between">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">

                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Chi tiết đơn hàng</h4>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout">
                        <table class="table no-border">
                            <tbody>
                            @foreach($carts as $item)
                                <tr>
                                    <td class="image product-thumbnail"><img
                                            src="{{ asset($item->options->image) }} "
                                            alt="#" style="width:50px; height: 50px;">
                                    </td>
                                    <td>
                                        <h6 class="w-160 mb-5">
                                            <a class="text-heading">{{ $item->name }}</a>
                                        </h6>
                                        <div class="product-rate-cover">

                                            <strong>Color :{{ $item->options->color }} </strong>
                                            <strong>Size : {{ $item->options->size }}</strong>

                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="text-muted pl-20 pr-20">x {{ $item->qty }}</h6>
                                    </td>
                                    <td>
                                        <h4 class="text-brand">{{ number_format($item->price, 0, '', '.') }}</h4>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                        <table class="table no-border">
                            <tbody>
                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-heading">Tổng cộng </h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h4 class="text-brand text-end">{{ $cartTotal }}</h4>
                                </td>
                            </tr>

                            <tr>
                                <td class="cart_total_label">
                                    <h6 class="text-heading">Địa chỉ nhận hàng </h6>
                                </td>
                                <td class="cart_total_amount">
                                    <h6 class="text-brand text-end">{{ $data['shipping_address'] }}</h6>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- // end lg md 6 -->

            <div class="col-lg-6">
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Thông tin chuyển khoản</h4>

                    </div>
                    <div class="divider-2 mb-30"></div>
                    <h4>Vui lòng chuyển khoản thông tin bên dưới:</h4>
                    <div class="table-responsive order_table checkout">
                        <form action="{{ route('bank.order') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <label for="card-element">
                                    <input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
                                    <input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
                                    <input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
                                    <input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
                                    <input type="hidden" name="division_id" value="{{ $data['division_id'] }}">
                                    <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
                                    <input type="hidden" name="state_id" value="{{ $data['state_id'] }}">
                                    <input type="hidden" name="address" value="{{ $data['shipping_address'] }}">
                                    <input type="hidden" name="notes" value="{{ $data['notes'] }}">
                                </label>
                            </div>
                            <br>
                            <table class="table no-border">
                                <tbody>

                                    <tr>
                                        <td>
                                            <h6 class="w-160 mb-5">
                                                <a class="text-heading">Sacombank</a>
                                            </h6>
                                        </td>
                                        <td>
                                            <h6 class="text-muted pl-20 pr-20">Trần Thị Ý Như </h6>
                                        </td>
                                        <td>
                                            <h4 class="text-brand">00000000000000</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <h6 class="w-160 mb-5">
                                                <a class="text-heading">MOMO</a>
                                            </h6>
                                        </td>
                                        <td>
                                            <h6 class="text-muted pl-20 pr-20">Trần Thị Ý Như</h6>
                                        </td>
                                        <td>
                                            <h4 class="text-brand">079 611 1154</h4>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <button class="btn btn-primary">Xác nhận đơn hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
