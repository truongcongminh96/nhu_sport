@php
    $brands = App\Models\Brand::orderBy('id','ASC')->limit(10)->get();
@endphp
<div class="container">

    <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">
        <h3 class="">Top thương hiệu</h3>
        <a class="show-all" href="shop-grid-right.html">
           Tất cả thương hiệu
            <i class="fi-rs-angle-right"></i>
        </a>
    </div>

    <div class="row vendor-grid">
        @foreach($brands as $brand)
        <div class="col-lg-3 col-md-6 col-12 col-sm-6 justify-content-center">
            <div class="vendor-wrap mb-40">
                <div class="vendor-img-action-wrap">
                    <div class="vendor-img">
                        <a href="vendor-details-1.html">
                            <img style="border-radius: 10px" class="default-img" src="{{ asset($brand->brand_image) }}" alt="" />
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
                                <span class="text-muted">Since 2012</span>
                            </div>
                            <h4 class="mb-5"><a href="vendor-details-1.html">{{ $brand->brand_name }}</a></h4>
                            <div class="product-rate-cover">
                                @php
                                    $countProduct = App\Models\Product::where(['brand_id' => $brand->id])->count();
                                @endphp
                                <span class="font-small total-product">{{ $countProduct }} sản phẩm</span>
                            </div>
                        </div>

                    </div>
                    <div class="vendor-info mb-30">
                        <ul class="contact-infor text-muted">

                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Call Us:</strong><span> 0796 1111 54</span></li>
                        </ul>
                    </div>
                    <a href="vendor-details-1.html" class="btn btn-xs">Offical Store <i class="fi-rs-arrow-small-right"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
