@extends('frontend.master_dashboard')
@section('main')
    @section('title')
        Như Sport - Shop bán vợt cầu lông chính hãng
    @endsection
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
                                            <a style="width: 100%" aria-label="Quick view" class="btn btn-sm hover-up"
                                               data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                               id="{{ $badmintonRacket->id }}" onclick="productView(this.id)">Xem nhanh</a>
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
                                            <a href="{{ url('product/category/'.$badmintonRacket['category']['id'].'/'.$badmintonRacket['category']['category_slug']) }}">{{ $badmintonRacket['category']['category_name'] }}</a>
                                        </div>
                                        <h2>
                                            <a style="height:2.5em;white-space: nowrap; display: block;text-overflow: ellipsis;overflow: hidden;"
                                               href="{{ url('product/details/'.$badmintonRacket->id.'/'.$badmintonRacket->product_slug) }}">{{ $badmintonRacket->product_name }}</a>
                                        </h2>

                                        <div>
                                            @if($badmintonRacket->vendor_id === NULL)
                                                <span class="font-small text-muted">By <a>Owner</a></span>
                                            @else
                                                <span class="font-small text-muted">By <a
                                                        href="{{ route('brand.details', $badmintonRacket['brand']['id']) }}">{{ $badmintonRacket['brand']['brand_name'] }}</a></span>
                                            @endif
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                @if($badmintonRacket->discount_price === NULL)
                                                    <span>{{ number_format($badmintonRacket->selling_price, 0, '') }} </span>
                                                @else
                                                    <span>{{ number_format($badmintonRacket->discount_price, 0, '') }} </span>
                                                    <span
                                                        class="old-price">{{ number_format($badmintonRacket->selling_price, 0, '') }}</span>
                                                @endif
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                                   id="{{ $badmintonRacket->id }}" onclick="productView(this.id)"><i
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
                <h3>Áo Cầu Lông</h3>
            </div>
            <!--End nav-tabs-->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">
                        @php
                            $badmintonShirts = App\Models\Product::where('category_id',3)->orderBy('id','DESC')->limit(6)->get();
                        @endphp
                        @foreach($badmintonShirts as $badmintonShirt)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                     data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$badmintonShirt->id.'/'.$badmintonShirt->product_slug) }}">
                                                <img class="default-img"
                                                     src="{{ asset( $badmintonShirt->product_thumbnail ) }}" alt=""/>
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a style="width: 100%" aria-label="Quick view" class="btn btn-sm hover-up"
                                               data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                               id="{{ $badmintonShirt->id }}" onclick="productView(this.id)">Xem nhanh</a>
                                        </div>
                                        @php
                                            $amount = $badmintonShirt->selling_price - $badmintonShirt->discount_price;
                                            $discount = ($amount/$badmintonShirt->selling_price) * 100;
                                        @endphp
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if($badmintonShirt->discount_price === NULL)
                                                <span class="new">New</span>
                                            @else
                                                <span class="hot"> {{ round($discount) }} %</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="{{ url('product/category/'.$badmintonShirt['category']['id'].'/'.$badmintonShirt['category']['category_slug']) }}">{{ $badmintonShirt['category']['category_name'] }}</a>
                                        </div>
                                        <h2>
                                            <a style="height:2.5em;white-space: nowrap; display: block;text-overflow: ellipsis;overflow: hidden;"
                                               href="{{ url('product/details/'.$badmintonShirt->id.'/'.$badmintonShirt->product_slug) }}">{{ $badmintonShirt->product_name }}</a>
                                        </h2>

                                        <div>
                                            @if($badmintonShirt->vendor_id === NULL)
                                                <span class="font-small text-muted">By <a href="#">Owner</a></span>
                                            @else
                                                <span class="font-small text-muted">By <a
                                                        href="{{ route('brand.details', $badmintonShirt['brand']['id']) }}">{{ $badmintonShirt['brand']['brand_name'] }}</a></span>
                                            @endif
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                @if($badmintonShirt->discount_price === NULL)
                                                    <span>{{ number_format($badmintonShirt->selling_price, 0, '') }}</span>
                                                @else
                                                    <span>{{ number_format($badmintonShirt->discount_price, 0, '') }} </span>
                                                    <span
                                                        class="old-price">{{ number_format($badmintonShirt->selling_price, 0, '') }}</span>
                                                @endif
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                                   id="{{ $badmintonShirt->id }}" onclick="productView(this.id)"><i
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


    <section class="product-tabs section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                <h3>Quần Cầu Lông</h3>
            </div>
            <!--End nav-tabs-->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">
                        @php
                            $badmintonShorts = App\Models\Product::where('category_id',5)->orderBy('id','DESC')->limit(6)->get();
                        @endphp
                        @foreach($badmintonShorts as $badmintonShort)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                     data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$badmintonShort->id.'/'.$badmintonShort->product_slug) }}">
                                                <img class="default-img"
                                                     src="{{ asset( $badmintonShort->product_thumbnail ) }}" alt=""/>
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a style="width: 100%" aria-label="Quick view" class="btn btn-sm hover-up"
                                               data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                               id="{{ $badmintonShort->id }}" onclick="productView(this.id)">Xem nhanh</a>
                                        </div>
                                        @php
                                            $amount = $badmintonShort->selling_price - $badmintonShort->discount_price;
                                            $discount = ($amount/$badmintonShort->selling_price) * 100;
                                        @endphp
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if($badmintonShort->discount_price === NULL)
                                                <span class="new">New</span>
                                            @else
                                                <span class="hot"> {{ round($discount) }} %</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="{{ url('product/category/'.$badmintonShort['category']['id'].'/'.$badmintonShort['category']['category_slug']) }}">{{ $badmintonShort['category']['category_name'] }}</a>
                                        </div>
                                        <h2>
                                            <a style="height:2.5em;white-space: nowrap; display: block;text-overflow: ellipsis;overflow: hidden;"
                                               href="{{ url('product/details/'.$badmintonShort->id.'/'.$badmintonShort->product_slug) }}">{{ $badmintonShort->product_name }}</a>
                                        </h2>

                                        <div>
                                            @if($badmintonShoe->vendor_id === NULL)
                                                <span class="font-small text-muted">By <a href="#">Owner</a></span>
                                            @else
                                                <span class="font-small text-muted">By <a
                                                        href="{{ route('brand.details', $badmintonShort['brand']['id']) }}">{{ $badmintonShort['brand']['brand_name'] }}</a></span>
                                            @endif
                                        </div>
                                        <div class="product-card-bottom">
                                            <div class="product-price">
                                                @if($badmintonShort->discount_price === NULL)
                                                    <span>{{ number_format($badmintonShort->selling_price, 0, '') }}</span>
                                                @else
                                                    <span>{{ number_format($badmintonShort->discount_price, 0, '') }} </span>
                                                    <span
                                                        class="old-price">{{ number_format($badmintonShort->selling_price, 0, '') }}</span>
                                                @endif
                                            </div>
                                            <div class="add-cart">
                                                <a class="add" data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                                   id="{{ $badmintonShort->id }}" onclick="productView(this.id)"><i
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
                    <h4 class="section-title style-1 mb-30 animated animated"> Váy cầu lông </h4>
                    <div class="product-list-small animated animated">
                        @foreach($badmintonDress as $badmintonSkirt)
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="{{ url('product/details/'.$badmintonSkirt->id.'/'.$badmintonSkirt->product_slug) }}">
                                        <img class="default-img"
                                             src="{{ asset( $badmintonSkirt->product_thumbnail ) }}" alt=""/>
                                    </a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a style="height:2.5em;white-space: nowrap; display: block;text-overflow: ellipsis;overflow: hidden;"
                                           href="{{ url('product/details/'.$badmintonSkirt->id.'/'.$badmintonSkirt->product_slug) }}">{{ $badmintonSkirt->product_name }}</a>
                                    </h6>
                                    <div>
                                        @if($hotDeal->vendor_id === NULL)
                                            <span class="font-small text-muted">By <a>Owner</a></span>
                                        @else
                                            <span class="font-small text-muted">By <a
                                                    href="{{ route('brand.details', $badmintonSkirt['brand']['id']) }}">{{ $badmintonSkirt['brand']['brand_name'] }}</a></span>
                                        @endif
                                    </div>
                                    @if($badmintonSkirt->discount_price === NULL)
                                        <div class="product-price">
                                            <span>{{ number_format($badmintonSkirt->selling_price, 0, '') }} </span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>{{ number_format($badmintonSkirt->discount_price, 0, '') }} </span>
                                            <span class="old-price">{{ number_format($badmintonSkirt->selling_price, 0, '') }} </span>
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp"
                     data-wow-delay=".1s">
                    <h4 class="section-title style-1 mb-30 animated animated"> Giày cầu lông </h4>
                    <div class="product-list-small animated animated">
                        @foreach($badmintonShoes as $badmintonShoe)
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="{{ url('product/details/'.$badmintonShoe->id.'/'.$badmintonShoe->product_slug) }}">
                                        <img class="default-img"
                                             src="{{ asset( $badmintonShoe->product_thumbnail ) }}" alt=""/>
                                    </a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a style="height:2.5em;white-space: nowrap; display: block;text-overflow: ellipsis;overflow: hidden;"
                                           href="{{ url('product/details/'.$badmintonShoe->id.'/'.$badmintonShoe->product_slug) }}">{{ $badmintonShoe->product_name }}</a>
                                    </h6>
                                    <div>
                                        @if($badmintonShoe->vendor_id === NULL)
                                            <span class="font-small text-muted">By <a>Owner</a></span>
                                        @else
                                            <span class="font-small text-muted">By <a
                                                    href="{{ route('brand.details', $badmintonShoe['brand']['id']) }}">{{ $badmintonShoe['brand']['brand_name'] }}</a></span>
                                        @endif
                                    </div>
                                    @if($badmintonShoe->discount_price === NULL)
                                        <div class="product-price">
                                            <span>{{ number_format($badmintonShoe->selling_price, 0, '') }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>{{ number_format($badmintonShoe->discount_price, 0, '') }} </span>
                                            <span class="old-price">{{ number_format($badmintonShoe->selling_price, 0, '') }}</span>
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
                    <h4 class="section-title style-1 mb-30 animated animated">Balo cầu lông</h4>
                    <div class="product-list-small animated animated">
                        @foreach($badmintonBackpack as $bBackpack)
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="{{ url('product/details/'.$bBackpack->id.'/'.$bBackpack->product_slug) }}">
                                        <img class="default-img"
                                             src="{{ asset( $bBackpack->product_thumbnail ) }}" alt=""/>
                                    </a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a style="height:2.5em;white-space: nowrap; display: block;text-overflow: ellipsis;overflow: hidden;"
                                           href="{{ url('product/details/'.$bBackpack->id.'/'.$bBackpack->product_slug) }}">{{ $bBackpack->product_name }}</a>
                                    </h6>
                                    <div>
                                        @if($bBackpack->vendor_id === NULL)
                                            <span class="font-small text-muted">By <a>Owner</a></span>
                                        @else
                                            <span class="font-small text-muted">By <a
                                                    href="{{ route('brand.details', $bBackpack['brand']['id']) }}">{{ $bBackpack['brand']['brand_name'] }}</a></span>
                                        @endif
                                    </div>
                                    @if($bBackpack->discount_price === NULL)
                                        <div class="product-price">
                                            <span>{{ number_format($bBackpack->selling_price, 0, '') }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>{{ number_format($bBackpack->discount_price, 0, '') }}</span>
                                            <span class="old-price">{{ number_format($bBackpack->selling_price, 0, '') }}</span>
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
                    <h4 class="section-title style-1 mb-30 animated animated">Túi vợt cầu lông</h4>
                    <div class="product-list-small animated animated">
                        @foreach($badmintonBag as $bBag)
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="{{ url('product/details/'.$bBag->id.'/'.$bBag->product_slug) }}">
                                        <img class="default-img"
                                             src="{{ asset( $bBag->product_thumbnail ) }}" alt=""/>
                                    </a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a style="height:2.5em;white-space: nowrap; display: block;text-overflow: ellipsis;overflow: hidden;"
                                           href="{{ url('product/details/'.$bBag->id.'/'.$bBag->product_slug) }}">{{ $bBag->product_name }}</a>
                                    </h6>
                                    <div>
                                        @if($bBag->vendor_id === NULL)
                                            <span class="font-small text-muted">By <a>Owner</a></span>
                                        @else
                                            <span class="font-small text-muted">By <a
                                                    href="{{ route('brand.details', $bBag['brand']['id']) }}">{{ $bBag['brand']['brand_name'] }}</a></span>
                                        @endif
                                    </div>
                                    @if($bBag->discount_price === NULL)
                                        <div class="product-price">
                                            <span>{{ number_format($bBag->selling_price, 0, '') }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>{{ number_format($bBag->discount_price, 0, '') }} </span>
                                            <span class="old-price">{{ number_format($bBag->selling_price, 0, '') }}</span>
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
