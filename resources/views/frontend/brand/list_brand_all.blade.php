@extends('frontend.master_dashboard')
@section('main')
    <main class="main pages mb-80">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
                    <span></span> Danh sách thương hiệu
                </div>
            </div>
        </div>
        <div class="page-content pt-50">
            <div class="container">
                <div class="archive-header-2 text-center">
                    <h1 class="display-2 mb-50">Danh Sách Thương Hiệu</h1>
                </div>
                <div class="row vendor-grid">
                    @foreach($brands as $brand)
                        <div class="col-lg-3 col-md-6 col-12 col-sm-6">
                            <div class="vendor-wrap mb-40">
                                <div class="vendor-img-action-wrap">
                                    <div class="vendor-img">
                                        <a href="{{ route('brand.details', $brand->id) }}">
                                            <img style="border-radius: 10px;" src="{{ (!empty($brand->brand_image)) ? url($brand->brand_image):url('upload/no_image.jpg') }}" alt=""/>
                                        </a>
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        <span class="hot">Mall</span>
                                    </div>
                                </div>
                                <div class="vendor-content-wrap">
                                    <div class="d-flex justify-content-between align-items-end mb-30">
                                        <div>
                                            <div class="product-category">
                                                <span class="text-muted">Since {{ $brand->brand_since }}</span>
                                            </div>
                                            <h4 class="mb-5"><a href="{{ route('brand.details', $brand->id) }}">{{ $brand->brand_name }}</a></h4>
                                            <div class="product-rate-cover">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                                            </div>
                                        </div>
                                        @php
                                            $countProduct = App\Models\Product::where(['brand_id' => $brand->id])->count();
                                        @endphp
                                        <div class="mb-10">
                                            <span class="font-small total-product">{{ $countProduct }} sản phẩm</span>
                                        </div>
                                    </div>
                                    <div class="vendor-info mb-30">
                                        <ul class="contact-infor text-muted">
                                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt=""/><strong>Address: </strong>
                                                <span>{{ $brand->brand_address }}</span>
                                            </li>
                                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt=""/><strong>Call
                                                    Us:</strong><span>0796 1111 54</span></li>
                                        </ul>
                                    </div>
                                    <a href="{{ route('brand.details', $brand->id) }}" class="btn btn-xs">Visit Store <i
                                            class="fi-rs-arrow-small-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!--end vendor card-->
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
