@php
    $categories = App\Models\Category::orderBy('id','ASC')->get();
@endphp
<script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>

<style>
    #searchProducts {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #ffffff;
        z-index: 999;
        border-radius: 8px;
        margin-top: 5px;
    }
</style>

<header class="header-area header-style-1 header-height-2">
    <div class="mobile-promotion">
        <span>Giảm giá <strong>lên đến 15%</strong> tất cả sản phẩm tại <strong>Như Sport</strong> </span>
    </div>
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>
                            <li><a href="{{ route('mycart') }}">NHƯ SPORT</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                <li>Giao hàng an toàn 100% mà không cần liên hệ với chuyển phát nhanh</li>
                                <li>Ưu đãi siêu giá trị - Tiết kiệm nhiều hơn với phiếu giảm giá</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            <li>Hotline: <strong class="text-brand"> 0796 1111 54</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/imgs/theme/logo.jpg') }}" alt="logo"/></a>
                </div>
                <div class="header-right">
                    <div class="search-style-2">
                        <form action="{{ route('product.search') }}" method="post">
                            @csrf
                            <select class="select-active">
                                <option>Danh mục</option>
                                @foreach($categories as $category)
                                    <option>{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            <input onfocus="search_result_show()" onblur="search_result_hide()" name="search"
                                   id="search" placeholder="Tìm kiếm nhanh..."/>
                            <div id="searchProducts"></div>
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('mycart') }}">
                                    <img alt="Nest"
                                         src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}"/>
                                    <span class="pro-count blue" id="cartQty">0 </span>
                                </a>
                                <a href="{{ route('mycart') }}"><span class="lable">Giỏ hàng</span></a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <div id="miniCart">

                                    </div>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Tổng cộng <span id="cartSubTotal"> </span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('mycart') }}" class="outline">Xem giỏ hàng</a>
                                            <a href="{{ route('checkout') }}">Thanh toán ngay</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $categories = App\Models\Category::orderBy('category_name','ASC')->get();
        $leftCategory = [];
        $rightCategory=[];
        foreach ($categories as $category) {
           if(($category->id %2) === 0) {
               $leftCategory[] = $category;
           } else {
              $rightCategory[] = $category;
           }
        }
    @endphp
    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/imgs/theme/logo.jpg') }}" alt="logo"/></a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categories-button-active" href="#">
                            <span class="fi-rs-apps"></span>Danh mục sản phẩm<i class="fi-rs-angle-down"></i>
                        </a>
                        <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                            <div class="d-flex categori-dropdown-inner">
                                <ul>
                                    @foreach($leftCategory as $item)
                                        <li>
                                            <a href="{{ url('product/category/'.$item->id.'/'.$item->category_slug) }}">
                                                <img src="{{ asset( $item->category_image ) }}"
                                                     alt=""/> {{ $item->category_name }} </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="end">
                                    @foreach($rightCategory as $item)
                                        <li>
                                            <a href="{{ url('product/category/'.$item->id.'/'.$item->category_slug) }}">
                                                <img src="{{ asset( $item->category_image ) }}"
                                                     alt=""/> {{ $item->category_name }} </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul>
                                <li>
                                    <a class="active" href="{{ url('/') }}">Trang chủ </a>

                                </li>
                                <li class="position-static">
                                    <a href="#">Sản phẩm <i class="fi-rs-angle-down"></i></a>
                                    @php
                                        $categories = App\Models\Category::orderBy('id','ASC')->get();
                                    @endphp
                                    <ul class="mega-menu">
                                        @foreach($categories as $category)
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">{{ $category->category_name }}</a>
                                                @php
                                                    $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name','ASC')->get();
                                                @endphp

                                                <ul>
                                                    @foreach($subcategories as $subcategory)
                                                        <li>
                                                            <a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a href="page-contact.html">Liên hệ</a>
                                </li>
                                <li>
                                    <a href="{{ route('home.blog') }}">Blog</a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>


                <div class="hotline d-none d-lg-flex">
                    <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-headphone.svg') }}" alt="hotline"/>
                    <p>0796 1111 54<span>24/7 Support Center</span></p>
                </div>
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="{{ route('mycart') }}">
                                <img alt="Nest" src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- End Header  -->
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/imgs/theme/logo.jpg') }}" alt="logo"/></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="{{ route('product.search') }}" method="post">
                    @csrf
                    <input onfocus="search_result_show()" onblur="search_result_hide()" name="search" id="search"
                           placeholder="Tìm kiếm nhanh..."/>
                    <button type="submit"><i class="fi-rs-search"></i></button>
                    <div id="searchProducts"></div>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu font-heading">
                        <li class="menu-item-has-children">
                            <a href="{{ url('/') }}">Trang chủ</a>

                        </li>
                        <li class="menu-item-has-children">
                            <a>Liên hệ</a>
                        </li>

                        <li class="menu-item-has-children">
                            <a>Sản phẩm</a>
                            @php
                                $categories = App\Models\Category::orderBy('id','ASC')->get();
                            @endphp
                            <ul class="dropdown">
                                @foreach($categories as $category)
                                <li class="menu-item-has-children">
                                    <a href="#">{{ $category->category_name }}</a>
                                    @php
                                        $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name','ASC')->get();
                                    @endphp
                                    <ul class="dropdown">
                                        @foreach($subcategories as $subcategory)
                                            <li>
                                                <a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="{{ route('home.blog') }}">Blog</a>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">
                <div class="single-mobile-header-info">
                    <a><i class="fi-rs-marker"></i> số 2a nguyễn hiến lê ,phường 13.tân bình,hcm (gần sân cầu lông viettel)</a>
                </div>
                <div class="single-mobile-header-info">
                    <a><i class="fi-rs-headphones"></i> 0796 1111 54 </a>
                </div>
            </div>
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">Follow Us</h6>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}" alt=""/></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}"
                                 alt=""/></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}" alt=""/></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest-white.svg') }}" alt=""/></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                                 alt=""/></a>
            </div>
            <div class="site-copyright">© 2022, Như - Như Sport All rights reserved</div>
        </div>
    </div>
</div>

<script>
    function search_result_show() {
        $("#searchProducts").slideDown();
    }

    function search_result_hide() {
        $("#searchProducts").slideUp();
    }
</script>
<script>
    const site_url = "http://127.0.0.1:8000/";
    $("body").on("keyup", "#search", function () {

        let text = $("#search").val();
        //console.log(text);

        if (text.length > 0) {
            $.ajax({
                data: {search: text},
                url: site_url + "search-product",
                method: 'post',
                beforSend: function (request) {
                    return request.setRequestHeader('X-CSRF-TOKEN', ("meta[name='csrf-token']"))
                },

                success: function (result) {
                    $("#searchProducts").html(result);

                }
            }); //End Ajax

        }// end if

        if (text.length < 1) $("#searchProducts").html("");

    });

</script>
