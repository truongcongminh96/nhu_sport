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
                <li><a href="{{ route('admin.dashboard') }}"><i class="bx bx-right-arrow-alt"></i>Default</a>
                </li>
                <li><a href="dashboard-eCommerce.html"><i class="bx bx-right-arrow-alt"></i>eCommerce</a>
                </li>
                <li><a href="dashboard-analytics.html"><i class="bx bx-right-arrow-alt"></i>Analytics</a>
                </li>
                <li><a href="dashboard-digital-marketing.html"><i class="bx bx-right-arrow-alt"></i>Digital
                        Marketing</a>
                </li>
                <li><a href="dashboard-human-resources.html"><i class="bx bx-right-arrow-alt"></i>Human
                        Resources</a>
                </li>
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
        <li class="menu-label">Forms & Tables</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-message-square-edit'></i>
                </div>
                <div class="menu-title">Quản lý Coupon</div>
            </a>
            <ul>
                <li><a href="{{ route('all.coupon') }}"><i class="bx bx-right-arrow-alt"></i>All Coupon</a>
                </li>
                <li><a href="form-input-group.html"><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-grid-alt"></i>
                </div>
                <div class="menu-title">Tables</div>
            </a>
            <ul>
                <li><a href="table-basic-table.html"><i class="bx bx-right-arrow-alt"></i>Basic Table</a>
                </li>
                <li><a href="table-datatable.html"><i class="bx bx-right-arrow-alt"></i>Data Table</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Pages</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-lock"></i>
                </div>
                <div class="menu-title">Authentication</div>
            </a>
            <ul>
                <li><a href="authentication-signin.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Sign
                        In</a>
                </li>
                <li><a href="authentication-signup.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Sign
                        Up</a>
                </li>
                <li><a href="authentication-signin-with-header-footer.html" target="_blank"><i
                            class="bx bx-right-arrow-alt"></i>Sign In with Header & Footer</a>
                </li>
                <li><a href="authentication-signup-with-header-footer.html" target="_blank"><i
                            class="bx bx-right-arrow-alt"></i>Sign Up with Header & Footer</a>
                </li>
                <li><a href="authentication-forgot-password.html" target="_blank"><i
                            class="bx bx-right-arrow-alt"></i>Forgot Password</a>
                </li>
                <li><a href="authentication-reset-password.html" target="_blank"><i
                            class="bx bx-right-arrow-alt"></i>Reset Password</a>
                </li>
                <li><a href="authentication-lock-screen.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Lock
                        Screen</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('admin.profile') }}">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">User Profile</div>
            </a>
        </li>
        <li>
            <a href="timeline.html">
                <div class="parent-icon"><i class="bx bx-video-recording"></i>
                </div>
                <div class="menu-title">Timeline</div>
            </a>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-error"></i>
                </div>
                <div class="menu-title">Errors</div>
            </a>
            <ul>
                <li><a href="errors-404-error.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>404
                        Error</a>
                </li>
                <li><a href="errors-500-error.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>500
                        Error</a>
                </li>
                <li><a href="errors-coming-soon.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Coming
                        Soon</a>
                </li>
                <li><a href="error-blank-page.html" target="_blank"><i class="bx bx-right-arrow-alt"></i>Blank Page</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="faq.html">
                <div class="parent-icon"><i class="bx bx-help-circle"></i>
                </div>
                <div class="menu-title">FAQ</div>
            </a>
        </li>
        <li>
            <a href="pricing-table.html">
                <div class="parent-icon"><i class="bx bx-diamond"></i>
                </div>
                <div class="menu-title">Pricing</div>
            </a>
        </li>
        <li class="menu-label">Charts & Maps</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-line-chart"></i>
                </div>
                <div class="menu-title">Charts</div>
            </a>
            <ul>
                <li><a href="charts-apex-chart.html"><i class="bx bx-right-arrow-alt"></i>Apex</a>
                </li>
                <li><a href="charts-chartjs.html"><i class="bx bx-right-arrow-alt"></i>Chartjs</a>
                </li>
                <li><a href="charts-highcharts.html"><i class="bx bx-right-arrow-alt"></i>Highcharts</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-map-alt"></i>
                </div>
                <div class="menu-title">Maps</div>
            </a>
            <ul>
                <li><a href="map-google-maps.html"><i class="bx bx-right-arrow-alt"></i>Google Maps</a>
                </li>
                <li><a href="map-vector-maps.html"><i class="bx bx-right-arrow-alt"></i>Vector Maps</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Others</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-menu"></i>
                </div>
                <div class="menu-title">Menu Levels</div>
            </a>
            <ul>
                <li><a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level One</a>
                    <ul>
                        <li><a class="has-arrow" href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level Two</a>
                            <ul>
                                <li><a href="javascript:;"><i class="bx bx-right-arrow-alt"></i>Level Three</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <a href="https://codervent.com/rukada/documentation/index.html" target="_blank">
                <div class="parent-icon"><i class="bx bx-folder"></i>
                </div>
                <div class="menu-title">Documentation</div>
            </a>
        </li>
        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
