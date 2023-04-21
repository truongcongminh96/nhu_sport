<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('admin_backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Như Sport</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}"><i class="bx bx-right-arrow-alt"></i>Default</a></li>
            </ul>
        </li>
        <li>
            <a class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Thương hiệu</div>
            </a>
            <ul>
                <li><a href="{{ route('all.brand') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách thương hiệu</a>
                </li>
                <li><a href="{{ route('add.brand') }}"><i class="bx bx-right-arrow-alt"></i>Thêm thương hiệu</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Loại sản phẩm</div>
            </a>
            <ul>
                <li><a href="{{ route('all.category') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách loại sản
                        phẩm</a></li>
                <li><a href="{{ route('add.category') }}"><i class="bx bx-right-arrow-alt"></i>Thêm loại sản phẩm</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">UI Elements</li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Loại sản phẩm phụ</div>
            </a>
            <ul>
                <li><a href="{{ route('all.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách loại sản
                        phẩm con</a>
                </li>
                <li><a href="{{ route('add.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Thêm loại sản phẩm con</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-grid-alt"></i>
                </div>
                <div class="menu-title">Quản lý sản phẩm</div>
            </a>
            <ul>
                <li><a href="{{ route('all.product') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách sản phẩm</a>
                </li>
                <li><a href="{{ route('add.product') }}"><i class="bx bx-right-arrow-alt"></i>Thêm sản phẩm</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Vendor Manage</div>
            </a>
            <ul>
                <li><a href="{{ route('inactive.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Inactive vendor</a>
                </li>
                <li><a href="{{ route('active.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Active Vendor</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Slider Manage</div>
            </a>
            <ul>
                <li><a href="{{ route('all.slider') }}"><i class="bx bx-right-arrow-alt"></i>All slider</a>
                </li>
                <li> <a href="{{ route('add.banner') }}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Banner Manage</div>
            </a>
            <ul>
                <li><a href="{{ route('all.banner') }}"><i class="bx bx-right-arrow-alt"></i>All Banner</a>
                </li>
                <li><a href="{{ route('add.banner') }}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
                </li>
            </ul>
        </li>
{{--        <li>--}}
{{--            <a class="has-arrow" href="javascript:;">--}}
{{--                <div class="parent-icon"><i class='bx bx-message-square-edit'></i>--}}
{{--                </div>--}}
{{--                <div class="menu-title">Quản lý Coupon</div>--}}
{{--            </a>--}}
{{--            <ul>--}}
{{--                <li><a href="{{ route('all.coupon') }}"><i class="bx bx-right-arrow-alt"></i>All Coupon</a>--}}
{{--                </li>--}}
{{--                <li><a href="form-input-group.html"><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}

        <li class="menu-label">Pages</li>
        <li>
            <a href="{{ route('admin.profile') }}">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">User Profile</div>
            </a>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Quản lý đơn hàng</div>
            </a>
            <ul>
                <li> <a href="{{ route('pending.order') }}"><i class="bx bx-right-arrow-alt"></i>Đơn chờ xác nhận</a>
                </li>
                <li> <a href="{{ route('admin.confirmed.order') }}"><i class="bx bx-right-arrow-alt"></i>Đơn đã xác nhận</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Blog</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.blog.category') }}"><i class="bx bx-right-arrow-alt"></i>Blog Category</a>
                </li>
                <li> <a href="{{ route('admin.blog.post') }}"><i class="bx bx-right-arrow-alt"></i>All Blog Post</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Setting Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('site.setting') }}"><i class="bx bx-right-arrow-alt"></i>Site Setting</a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>
