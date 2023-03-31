@php
    $featured = App\Models\Product::where('featured',1)->orderBy('id','DESC')->limit(6)->get();
@endphp
<section class="section-padding pb-5">
    <div class="container">
        <div class="section-title wow animate__animated animate__fadeIn">
            <h3 class=""> Sản phẩm nổi bật </h3>
        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                <div class="banner-img style-2">
                    <div class="banner-text">
                        <a href="#" class="btn btn-xs">Shop Now <i
                                class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                 id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                @foreach($featured as $product)
                                    <div class="product-cart-wrap">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                    <img class="default-img"
                                                         src="{{ asset( $product->product_thumbnail ) }}" alt=""/>
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a style="width: 100%" aria-label="Quick view"
                                                   class="btn btn-sm hover-up" data-bs-toggle="modal"
                                                   data-bs-target="#quickViewModal" id="{{ $product->id }}"
                                                   onclick="productView(this.id)">xem nhanh</a>
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
                                                <a href="{{ url('product/category/'.$product['category']['id'].'/'.$product['category']['category_slug']) }}">{{ $product['category']['category_name'] }}</a>
                                            </div>
                                            <h2>
                                                <a style="height:2.5em;white-space: nowrap; display: block;text-overflow: ellipsis;overflow: hidden;"
                                                   href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a>
                                            </h2>
                                            <div>
                                                @if($product->vendor_id === NULL)
                                                    <span class="font-small text-muted">By <a>Owner</a></span>
                                                @else
                                                    <span class="font-small text-muted">By <a
                                                            href="{{ route('brand.details', $product['brand']['id']) }}">{{ $product['brand']['brand_name'] }}</a></span>
                                                @endif
                                            </div>
                                            @if($product->discount_price === NULL)
                                                <div class="product-price mt-10">
                                                    <span>{{ number_format($product->selling_price, 0, '') }} </span>
                                                </div>
                                            @else
                                                <div class="product-price mt-10">
                                                    <span>{{ number_format($product->discount_price, 0, '') }} </span>
                                                    <span
                                                        class="old-price">{{ number_format($product->selling_price, 0, '') }}</span>
                                                </div>
                                            @endif
                                            <div class="sold mt-15 mb-15">
                                                <div class="progress mb-5">
                                                    <div class="progress-bar" role="progressbar" style="width: 50%"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <span class="font-xs text-heading">Còn hàng</span>
                                            </div>
                                            <a class="btn w-100 hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"><i class="fi-rs-shopping-cart mr-5"></i>Thêm vào giỏ</a>
                                        </div>
                                    </div>
                                @endforeach
                                <!--End product Wrap-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
