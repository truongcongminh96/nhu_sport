@extends('frontend.master_dashboard')
@section('main')
    @include('frontend.home.home_slider')
    <!--End hero slider-->
    @include('frontend.home.home_features_category')
    <!--End category slider-->
    @include('frontend.home.home_banner')
    <!--End banners-->
    @include('frontend.home.home_new_product')
    <!--Products Tabs-->
    @include('frontend.home.home_features_product')
    <!--End Best Sales-->
    <section class="product-tabs section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                <h3>Vợt Cầu Lông</h3>
            </div>
            <!--End nav-tabs-->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">
                        @php
                            $badmintonRackets = App\Models\Product::where('category_id',1)->orderBy('id','DESC')->limit(6)->get();
                        @endphp
                        @foreach($badmintonRackets as $badmintonRacket)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                     data-wow-delay=".5s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$badmintonRacket->id.'/'.$badmintonRacket->product_slug) }}">
                                                <img class="default-img"
                                                     src="{{ asset( $badmintonRacket->product_thumbnail ) }}" alt=""/>
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn"
                                               href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i
                                                    class="fi-rs-shuffle"></i></a>
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $badmintonRacket->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                        </div>
                                        @php
                                            $amount = $badmintonRacket->selling_price - $badmintonRacket->discount_price;
                                            $discount = ($amount/$badmintonRacket->selling_price) * 100;
                                        @endphp
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if($badmintonRacket->discount_price === NULL)
                                                <span class="new">New</span>
                                            @else
                                                <span class="hot"> {{ round($discount) }} %</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">{{ $badmintonRacket['category']['category_name'] }}</a>
                                        </div>
                                        <h2>
                                            <a style="height:2.5em;white-space: nowrap; display: block;text-overflow: ellipsis;overflow: hidden;"
                                               href="{{ url('product/details/'.$badmintonRacket->id.'/'.$badmintonRacket->product_slug) }}">{{ $badmintonRacket->product_name }}</a>
                                        </h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            @if($badmintonRacket->vendor_id === NULL)
                                                <span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>
                                            @else
                                                <span class="font-small text-muted">By <a
                                                        href="vendor-details-1.html">{{ $badmintonRacket['vendor']['name'] }}</a></span>
                                            @endif
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                @if($badmintonRacket->discount_price === NULL)
                                                    <span>${{ $badmintonRacket->selling_price }} </span>
                                                @else
                                                    <span>${{ $badmintonRacket->discount_price }} </span>
                                                    <span
                                                        class="old-price">${{ $badmintonRacket->selling_price }}</span>
                                                @endif
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i
                                                        class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end product card-->
                        @endforeach
                    </div>
                    <!--End product-grid-4-->
                </div>
            </div>
            <!--End tab-content-->
        </div>
    </section>

    <section class="product-tabs section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                <h3>Giày Cầu Lông </h3>
            </div>
            <!--End nav-tabs-->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">
                        @php
                            $badmintonShoes = App\Models\Product::where('category_id',2)->orderBy('id','DESC')->limit(6)->get();
                        @endphp
                        @foreach($badmintonShoes as $badmintonShoe)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                     data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$badmintonShoe->id.'/'.$badmintonShoe->product_slug) }}">
                                                <img class="default-img"
                                                     src="{{ asset( $badmintonShoe->product_thumbnail ) }}" alt=""/>
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn"
                                               href="shop-wishlist.html"><i
                                                    class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i
                                                    class="fi-rs-shuffle"></i></a>
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $badmintonShoe->id }}" onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                        </div>
                                        @php
                                            $amount = $badmintonShoe->selling_price - $badmintonShoe->discount_price;
                                            $discount = ($amount/$badmintonShoe->selling_price) * 100;
                                        @endphp
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if($badmintonShoe->discount_price === NULL)
                                                <span class="new">New</span>
                                            @else
                                                <span class="hot"> {{ round($discount) }} %</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">{{ $badmintonShoe['category']['category_name'] }}</a>
                                        </div>
                                        <h2>
                                            <a style="height:2.5em;white-space: nowrap; display: block;text-overflow: ellipsis;overflow: hidden;"
                                               href="{{ url('product/details/'.$badmintonShoe->id.'/'.$badmintonShoe->product_slug) }}">{{ $badmintonShoe->product_name }}</a>
                                        </h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            @if($badmintonShoe->vendor_id === NULL)
                                                <span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>
                                            @else
                                                <span class="font-small text-muted">By <a
                                                        href="vendor-details-1.html">{{ $badmintonRacket['vendor']['name'] }}</a></span>
                                            @endif
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                @if($badmintonRacket->discount_price === NULL)
                                                    <span>${{ $badmintonRacket->selling_price }} </span>
                                                @else
                                                    <span>${{ $badmintonRacket->discount_price }} </span>
                                                    <span
                                                        class="old-price">${{ $badmintonRacket->selling_price }}</span>
                                                @endif
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" href="shop-cart.html"><i
                                                        class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--End product-grid-4-->
                </div>
            </div>
            <!--End tab-content-->
        </div>
    </section>
    <!--End Tshirt Category -->
    <section class="section-padding mb-30">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp"
                     data-wow-delay="0">
                    <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                    <div class="product-list-small animated animated">
                        @foreach($hotDeals as $hotDeal)
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="{{ url('product/details/'.$hotDeal->id.'/'.$hotDeal->product_slug) }}">
                                        <img class="default-img"
                                             src="{{ asset( $hotDeal->product_thumbnail ) }}" alt=""/>
                                    </a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a style="height:2.5em;white-space: nowrap; display: block;text-overflow: ellipsis;overflow: hidden;"
                                           href="{{ url('product/details/'.$hotDeal->id.'/'.$hotDeal->product_slug) }}">{{ $hotDeal->product_name }}</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    @if($hotDeal->discount_price === NULL)
                                        <div class="product-price">
                                            <span>${{ $hotDeal->selling_price }} </span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>${{ $hotDeal->discount_price }} </span>
                                            <span class="old-price">${{ $hotDeal->selling_price }}</span>
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp"
                     data-wow-delay=".1s">
                    <h4 class="section-title style-1 mb-30 animated animated"> Special Offer </h4>
                    <div class="product-list-small animated animated">
                        @foreach($specialOffer as $special)
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="{{ url('product/details/'.$special->id.'/'.$special->product_slug) }}">
                                        <img class="default-img"
                                             src="{{ asset( $special->product_thumbnail ) }}" alt=""/>
                                    </a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a style="height:2.5em;white-space: nowrap; display: block;text-overflow: ellipsis;overflow: hidden;"
                                           href="{{ url('product/details/'.$special->id.'/'.$special->product_slug) }}">{{ $special->product_name }}</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    @if($hotDeal->discount_price === NULL)
                                        <div class="product-price">
                                            <span>${{ $special->selling_price }} </span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>${{ $special->discount_price }} </span>
                                            <span class="old-price">${{ $special->selling_price }}</span>
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div
                    class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp"
                    data-wow-delay=".2s">
                    <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                    <div class="product-list-small animated animated">
                        @foreach($featured as $recentlyAdded)
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="{{ url('product/details/'.$recentlyAdded->id.'/'.$recentlyAdded->product_slug) }}">
                                        <img class="default-img"
                                             src="{{ asset( $recentlyAdded->product_thumbnail ) }}" alt=""/>
                                    </a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a style="height:2.5em;white-space: nowrap; display: block;text-overflow: ellipsis;overflow: hidden;"
                                           href="{{ url('product/details/'.$recentlyAdded->id.'/'.$recentlyAdded->product_slug) }}">{{ $recentlyAdded->product_name }}</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    @if($recentlyAdded->discount_price === NULL)
                                        <div class="product-price">
                                            <span>${{ $recentlyAdded->selling_price }} </span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>${{ $recentlyAdded->discount_price }} </span>
                                            <span class="old-price">${{ $recentlyAdded->selling_price }}</span>
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div
                    class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp"
                    data-wow-delay=".3s">
                    <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                    <div class="product-list-small animated animated">
                        @foreach($specialDeals as $specialDeal)
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="{{ url('product/details/'.$specialDeal->id.'/'.$specialDeal->product_slug) }}">
                                        <img class="default-img"
                                             src="{{ asset( $specialDeal->product_thumbnail ) }}" alt=""/>
                                    </a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a style="height:2.5em;white-space: nowrap; display: block;text-overflow: ellipsis;overflow: hidden;"
                                           href="{{ url('product/details/'.$specialDeal->id.'/'.$specialDeal->product_slug) }}">{{ $specialDeal->product_name }}</a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    @if($specialDeal->discount_price === NULL)
                                        <div class="product-price">
                                            <span>${{ $specialDeal->selling_price }} </span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>${{ $specialDeal->discount_price }} </span>
                                            <span class="old-price">${{ $specialDeal->selling_price }}</span>
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End 4 columns-->

    @include('frontend.home.home_vendor_list')
    <!--End Vendor List -->
@endsection
