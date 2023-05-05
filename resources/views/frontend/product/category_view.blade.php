@extends('frontend.master_dashboard')
@section('main')
    @section('title')
        {{ $breadCategory->category_name }} Category
    @endsection
    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">{{ $breadCategory->category_name }}</h1>
                        <div class="breadcrumb">
                            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
                            <span></span> Shop <span></span> {{ $breadCategory->category_name }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>Chúng tôi tìm thấy <strong class="text-brand">{{ count($products) }}</strong> sản phẩm cho
                            bạn!</p>
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
                    @foreach($products as $product)
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
                                        @if($product->discount_price == NULL)
                                            <span class="new">New</span>
                                        @else
                                            <span class="hot"> {{ round($discount) }} %</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="{{ url('product/category/'.$product['category']['id'].'/'.$product['category']['category_slug']) }}">{{ $product['category']['category_name'] }}</a>
                                    </div>
                                    <h2>
                                        <a style="height:2.5em;white-space: nowrap; display: block;text-overflow: ellipsis;overflow: hidden;"
                                           href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a>
                                    </h2>
                                    <div>
                                        <span>Hãng: {{ $product['brand']['brand_name'] }} </span>
                                    </div>
                                    <div>
                                        @if($product->vendor_id == NULL)
                                            <span class="font-small text-muted">By <a
                                                    href="vendor-details-1.html">Owner</a></span>
                                        @else
                                            <span class="font-small text-muted">By <a
                                                    href="vendor-details-1.html">{{ $product['vendor']['name'] }}</a></span>

                                        @endif
                                    </div>
                                    <div class="product-card-bottom">
                                        @if($product->discount_price == NULL)
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
                        <!--end product card-->
                    @endforeach
                </div>
                <!--product grid-->
                {{ $products->links() }}

            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Danh mục</h5>
                    <ul>
                        @foreach($categories as $category)
                            @php
                                $products = App\Models\Product::where('category_id',$category->id)->get();
                            @endphp
                            <li>
                                <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}">
                                    <img src="{{ asset( $category->category_image ) }}"
                                         alt=""/> {{ $category->category_name }} </a>
                                <span class="count">{{ count($products) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Fillter By Price -->
                <!-- Product sidebar Widget -->
                <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                    <h5 class="section-title style-1 mb-30">{{ $breadCategory->category_name }} MỚI</h5>
                    @php
                        $newProductsOfCategory = App\Models\Product::where('category_id', $breadCategory->id)->orderBy('id', 'DESC')->limit(3)->get();
                    @endphp
                    @foreach($newProductsOfCategory as $product)
                        <div class="single-post clearfix">
                            <div class="image">
                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                    <img class="default-img"
                                         src="{{ asset( $product->product_thumbnail ) }}" alt=""/>
                                </a>
                            </div>
                            <div class="content pt-10">
                                <p>
                                    <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a>
                                </p>
                                @if($product->discount_price == NULL)
                                    <p class="price mb-0 mt-5">{{ number_format($product->selling_price, 0, '') }}</p>
                                @else
                                    <p class="price mb-0 mt-5">{{ number_format($product->discount_price, 0, '') }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
