<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Như Sport - Shop Bán Vợt Cầu Lông Chính Hãng 2022 Giá Rẻ Toàn Quốc</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta name="description"
          content="Như Sport - Shop bán vợt cầu lông Yonex chính hãng, vợt Victor, vợt Lining 2022... và là điểm mua vợt cầu lông giá rẻ, báo giá vợt cầu lông, COD toàn quốc."/>
    <meta name="keywords"
          content="Shop Vợt cầu lông, vợt cầu lông giá rẻ, vot cau long, mua vợt cầu lông, giá vợt cầu lông, vợt cầu lông yonex, vợt cầu lông proace,  vợt yonex chính hãng, vợt Victor,  vợt Lining, vợt cầu lông Apacs,"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:title" content=""/>
    <meta property="og:type" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:image" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.ico') }}"/>
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/animate.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3') }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/slider-range.css') }}"/>
</head>

<body>
<!-- Modal -->

<!-- Quick view -->
@include('frontend.body.quick_view')
<!-- Header  -->
@include('frontend.body.header')
<!--End header-->

<main class="main">
    @yield('main')
</main>

@include('frontend.body.footer')
<!-- Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="text-center">
                <img src="{{ asset('frontend/assets/imgs/theme/loading.gif') }}" alt=""/>
            </div>
        </div>
    </div>
</div>
<!-- Vendor JS-->
<script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/slick.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/waypoints.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/wow.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/select2.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/counterup.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/images-loaded.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/isotope.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/slider-range.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/sweetalert2.all.min.js') }}"></script>
<!-- Template  JS -->
<script src="{{ asset('frontend/assets/js/main.js?v=5.3') }}"></script>
<script src="{{ asset('frontend/assets/js/shop.js?v=5.3') }}"></script>
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    function productView(id) {
        $.ajax({
            type: 'GET',
            url: '/product/view/modal/' + id,
            dataType: 'json',
            success: function (data) {
                $('#pname').text(data.product.product_name);
                $('#pprice').text(data.product.selling_price);
                $('#pcode').text(data.product.product_code);
                $('#pcategory').text(data.product.category.category_name);
                $('#pbrand').text(data.product.brand.brand_name);
                $('#pimage').attr('src', '/' + data.product.product_thumbnail);

                $('#product_id').val(id);
                $('#qty').val(1);

                if (data.product.discount_price == null) {
                    $('#pprice').text('');
                    $('#oldprice').text('');
                    $('#pprice').text(data.product.selling_price);
                } else {
                    $('#pprice').text(data.product.discount_price);
                    $('#oldprice').text(data.product.selling_price);
                }

                if (data.product.product_qty > 0) {
                    $('#aviable').text('');
                    $('#stockout').text('');
                    $('#aviable').text('aviable');
                } else {
                    $('#aviable').text('');
                    $('#stockout').text('');
                    $('#stockout').text('stockout');
                }

                $('select[name="size"]').empty();
                $.each(data.size, function (key, value) {
                    $('select[name="size"]').append('<option value="' + value + ' ">' + value + '  </option')
                    if (data.size == "") {
                        $('#sizeArea').hide();
                    } else {
                        $('#sizeArea').show();
                    }
                })

                $('select[name="color"]').empty();
                $.each(data.color, function (key, value) {
                    $('select[name="color"]').append('<option value="' + value + ' ">' + value + '  </option')
                    if (data.color == "") {
                        $('#colorArea').hide();
                    } else {
                        $('#colorArea').show();
                    }
                })

            }
        })
    }

    function addToCart() {
        var product_name = $('#pname').text();
        var id = $('#product_id').val();
        var color = $('#color option:selected').text();
        var size = $('#size option:selected').text();
        var quantity = $('#qty').val();
        $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    color: color, size: size, quantity: quantity, product_name: product_name
                },
                url: "/cart/data/store/" + id,
                success: function (data) {
                    miniCart();
                    $('#closeModal').click();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success,
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error,
                        })
                    }
                    // End Message
                }

            }
        )
    }

    /// Start Details Page Add To Cart Product
    function addToCartDetails() {
        var product_name = $('#dpname').text();
        var id = $('#dproduct_id').val();
        var color = $('#dcolor option:selected').text();
        var size = $('#dsize option:selected').text();
        var quantity = $('#dqty').val();
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: {
                color: color, size: size, quantity: quantity, product_name: product_name
            },
            url: "/dcart/data/store/" + id,
            success: function (data) {
                miniCart();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        title: data.success,
                    })
                } else {

                    Toast.fire({
                        type: 'error',
                        title: data.error,
                    })
                }
                // End Message
            }
        })
    }

</script>

<script type="text/javascript">
    function miniCart() {
        $.ajax({
            type: 'GET',
            url: '/product/mini/cart',
            dataType: 'json',
            success: function (response) {
                $('span[id="cartSubTotal"]').text(response.cartTotal);
                $('#cartQty').text(response.cartQty);

                var miniCart = ""
                $.each(response.carts, function (key, value) {
                    miniCart += ` <ul>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="shop-product-right.html"><img alt="Nest" src="/${value.options.image} " style="width:50px;height:50px;" /></a>
                                        </div>
                                        <div class="shopping-cart-title" style="margin: -73px 74px 14px; width" 146px;>
                                            <h4><a href="shop-product-right.html"> ${value.name} </a></h4>
                                            <h4><span>${value.qty} × </span>${value.price}</h4>
                                        </div>
                                        <div class="shopping-cart-delete" style="margin: -85px 1px 0px;">
                                            <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"  ><i class="fi-rs-cross-small"></i></a>
                                        </div>
                                    </li>
                                </ul>
        <hr><br>
               `
                });
                $('#miniCart').html(miniCart);

            }
        })
    }

    miniCart();

    function miniCartRemove(rowId) {
        $.ajax({
            type: 'GET',
            url: '/minicart/product/remove/' + rowId,
            dataType: 'json',
            success: function (data) {
                miniCart();
                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        title: data.success,
                    })
                } else {

                    Toast.fire({
                        type: 'error',
                        title: data.error,
                    })
                }
                // End Message
            }
        })
    }

</script>

<!--  // Start Load MY Cart // -->
<script type="text/javascript">
    function cart() {
        $.ajax({
            type: 'GET',
            url: '/get-cart-product',
            dataType: 'json',
            success: function (response) {
                // console.log(response)

                var rows = ""
                $.each(response.carts, function (key, value) {
                    rows += `<tr class="pt-30">
            <td class="custome-checkbox pl-30">

            </td>
            <td class="image product-thumbnail pt-40"><img src="/${value.options.image} " alt="#"></td>
            <td class="product-des product-name">
                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">${value.name} </a></h6>

            </td>
            <td class="price" data-title="Price">
                <h4 class="text-body">${value.price} </h4>
            </td>
              <td class="price" data-title="Price">
              ${value.options.color == null
                        ? `<span>.... </span>`
                        : `<h6 class="text-body">${value.options.color} </h6>`
                    }
            </td>
               <td class="price" data-title="Price">
              ${value.options.size == null
                        ? `<span>.... </span>`
                        : `<h6 class="text-body">${value.options.size} </h6>`
                    }
            </td>
            <td class="text-center detail-info" data-title="Stock">
                <div class="detail-extralink mr-15">
                    <div class="detail-qty border radius">
                        <a type="submit" class="qty-down" id="${value.rowId}" onclick="cartDecrement(this.id)"><i class="fi-rs-angle-small-down"></i></a>

      <input type="text" name="quantity" class="qty-val" value="${value.qty}" min="1">
                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                    </div>
                </div>
            </td>
            <td class="price" data-title="Price">
                <h4 class="text-brand">${value.subtotal} </h4>
            </td>
                        <td class="action text-center" data-title="Remove">
            <a type="submit" class="text-body"  id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fi-rs-trash"></i></a></td>
        </tr>`
                });
                $('#cartPage').html(rows);
            }
        })
    }

    cart();

    // Cart Remove Start
    function cartRemove(id) {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/cart-remove/" + id,
            success: function (data) {
                cart();
                miniCart();
                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',

                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })
                } else {

                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }
                // End Message
            }
        })
    }

    // Cart Remove End

    // Cart Decrement Start
    function cartDecrement(rowId) {
        $.ajax({
            type: 'GET',
            url: "/cart-decrement/" + rowId,
            dataType: 'json',
            success: function (data) {
                cart();
                miniCart();
            }
        });
    }

    // Cart Decrement End
</script>
<!--  // End Load MY Cart // -->
</body>
</html>
