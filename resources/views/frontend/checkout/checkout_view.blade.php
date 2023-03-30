@extends('frontend.master_dashboard')
@section('main')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
                <span></span> Thanh Toán
            </div>
        </div>
    </div>
    <form method="post" action="{{ route('checkout.store') }}">
        @csrf
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h3 class="heading-2 mb-10">Thanh Toán</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">

                    <div class="row">
                        <h4 class="mb-30">Thông tin khách hàng</h4>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <input type="text" required="" name="shipping_name" value="Họ tên khách hàng">
                            </div>
                            <div class="form-group col-lg-6">
                                <input type="email" required="" name="shipping_email" value="email">
                            </div>
                        </div>


                        <div class="row shipping_calculator">
                            <div class="form-group col-lg-6">
                                <input required="" type="text" name="shipping_phone" value="Số điện thoại">
                            </div>
                        </div>

                        <div class="row shipping_calculator">
                            <div class="form-group col-lg-6">
                                <input required="" type="text" name="shipping_address" placeholder="Address *" value="">
                            </div>
                        </div>


                        <div class="form-group mb-30">
                            <textarea rows="5" placeholder="Additional information" name="notes"></textarea>
                        </div>


                    </div>
                </div>


                <div class="col-lg-5">
                    <div class="border p-40 cart-totals ml-30 mb-50">
                        <div class="d-flex align-items-end justify-content-between mb-30">
                            <h4>Đơn hàng của bạn</h4>

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
                                            <h6 class="w-160 mb-5"><a href="shop-product-full.html"
                                                                      class="text-heading">{{ $item->name }}</a>
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
                                        <h6 class="text-muted">Tổng cộng </h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">{{ $cartTotal }}</h4>
                                    </td>
                                </tr>


                                </tbody>
                            </table>


                        </div>
                    </div>
                    <div class="payment ml-30">
                        <h4 class="mb-30">Hình thức thanh toán</h4>
                        <div class="payment_option">
                            <div class="custome-radio">

                                <input class="form-check-input" required="" type="radio" name="payment_option"
                                       value="cash"
                                       id="exampleRadios4" checked="">

                                <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse"
                                       data-target="#checkPayment" aria-controls="checkPayment">Thanh toán khi nhận
                                    hàng</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" value="bank" required="" type="radio"
                                       name="payment_option"
                                       id="exampleRadios5" checked="">

                                <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse"
                                       data-target="#paypal" aria-controls="paypal">Chuyển khoản</label>
                            </div>
                        </div>
                        <div class="payment-logo d-flex">
                            <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-paypal.svg') }}"
                                 alt="">
                            <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-visa.svg') }}"
                                 alt="">
                            <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-master.svg') }}"
                                 alt="">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/payment-zapper.svg') }}" alt="">
                        </div>
                        <button type="submit" class="btn btn-fill-out btn-block mt-30">Place an Order<i
                                class="fi-rs-sign-out ml-15"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
