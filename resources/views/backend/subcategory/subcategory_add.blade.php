@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <script src="{{ asset('admin_backend/assets/js/jquery.min.js') }}"></script>
        <!--wrapper-->
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Thêm loại sản phẩm</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm loại sản phẩm</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown"><span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"><a class="dropdown-item"
                                                                                           href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <form id="myForm" method="POST" action="{{ route('store.category')}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Chọn loại sản phẩm</h6>
                                        </div>
                                        <div class="col-sm-9 mx-auto">
                                            <select class="single-select">
                                                <option value="">Chọn loại sản phẩm</option>
                                                @foreach($categories as $category)
                                                    <option
                                                        value="United Kingdom">{{ $category->category_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Hình ảnh</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" name="category_image" class="form-control" id="image"
                                                   required/>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage"
                                                 src="{{url('upload/no_image.jpg')}}"
                                                 alt="Admin"
                                                 style="width: 100px; height: 100px;">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Xác nhận"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
    <!--end wrapper-->

@endsection
