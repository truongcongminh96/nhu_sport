@extends('frontend.master_dashboard')
@section('main')
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
                <span></span> Cửa hàng <span></span> Thương hiệu
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="archive-header-2 text-center pt-80 pb-50">
            <h1 class="display-2 mb-50">{{ $brand->brand_name }}</h1>

        </div>
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>Chúng tôi tìm thấy <strong class="text-brand">{{ count($brandProduct) }}</strong> sản phẩm
                            cho bạn!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps-sort"></i>Sắp xếp:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> Mặc định <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">Featured</a></li>
                                    <li><a href="#">Price: Low to High</a></li>
                                    <li><a href="#">Price: High to Low</a></li>
                                    <li><a href="#">Release Date</a></li>
                                    <li><a href="#">Avg. Rating</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row product-grid">
                    @foreach($brandProduct as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                            <img class="default-img" src="{{ asset( $product->product_thumbnail ) }}"
                                                 alt=""/>

                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a style="width: 100%" aria-label="Quick view" class="btn btn-sm hover-up"
                                           data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                           id="{{ $product->id }}" onclick="productView(this.id)">Xem nhanh</a>
                                    </div>
                                    @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount/$product->selling_price) * 100;
                                    @endphp

                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        @if($product->discount_price === NULL)
                                            <span class="new">New</span>
                                        @else
                                            <span class="hot"> {{ round($discount) }} %</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a>{{ $product['category']['category_name'] }}</a>
                                    </div>
                                    <h2>
                                        <a style="height:2.5em;white-space: nowrap; display: block;text-overflow: ellipsis;overflow: hidden;"
                                           href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a>
                                    </h2>
                                    <div>
                                        @if($product->vendor_id === NULL)
                                            <span class="font-small text-muted">By <a>Owner</a></span>
                                        @else
                                            <span
                                                class="font-small text-muted">By <a>{{ $product['vendor']['name'] }}</a></span>

                                        @endif
                                    </div>
                                    <div class="product-card-bottom">
                                        @if($product->discount_price === NULL)
                                            <div class="product-price">
                                                <span>{{ number_format($product->selling_price, 0, '') }}</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span>{{ number_format($product->discount_price, 0, '') }}</span>
                                                <span
                                                    class="old-price">{{ number_format($product->selling_price, 0, '') }}</span>
                                            </div>
                                        @endif
                                        <div class="add-cart">
                                            <a class="add" data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                               id="{{ $product->id }}" onclick="productView(this.id)"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!--product grid-->
                {{ $brandProduct->links() }}
                <!--End Deals-->
            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
                    <div class="vendor-logo mb-30">
                        <img style="border-radius: 10px;"
                             src="{{ (!empty($brand->brand_image)) ? url($brand->brand_image):url('upload/no_image.jpg') }}"
                             alt=""/>
                    </div>
                    <div class="vendor-info">
                        <div class="product-category">
                            <span class="text-muted">Since {{ $brand->brand_since }}</span>
                        </div>
                        <h4 class="mb-5"><a class="text-heading">{{ $brand->brand_name }}</a></h4>
                        <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                        </div>
                        <div class="vendor-des mb-30">
                            <p class="font-sm text-heading">{{ $brand->short_info }}</p>
                        </div>
                        <div class="follow-social mb-20">
                            <h6 class="mb-15">Follow Us</h6>
                            <ul class="social-network">
                                <li class="hover-up">
                                    <a>
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-tw.svg') }}"
                                             alt=""/>
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a>
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-fb.svg') }}"
                                             alt=""/>
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a>
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-insta.svg') }}"
                                             alt=""/>
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a>
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-pin.svg') }}"
                                             alt=""/>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="vendor-info">
                            <ul class="font-sm mb-20">
                                <li><img class="mr-5"
                                         src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}"
                                         alt=""/><strong>Address: </strong>
                                    <span>{{ $brand->brand_address }}</span></li>
                                <li><img class="mr-5"
                                         src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt=""/><strong>Call
                                        Us:</strong><span>0796 1111 54</span></li>
                            </ul>
                            <a class="btn btn-xs">Gọi: 0796 1111 54</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
