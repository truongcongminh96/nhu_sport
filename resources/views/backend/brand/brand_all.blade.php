@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Thương hiệu</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Thương hiệu</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Cài đặt</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown"><span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"><a class="dropdown-item" href="{{ route('add.brand') }}">Thêm thương hiệu</a>
                        <a class="dropdown-item" href="">Another action</a>
                        <a class="dropdown-item" href="">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="">Separated link</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Danh sách thương hiệu</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên thương hiệu</th>
                            <th>Hình ảnh</th>
                            <th>Hoạt động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $key => $brand)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $brand->brand_name }}</td>
                                <td><img alt="" src="{{ asset($brand->brand_image) }}"
                                         style="width: 50px; height: 50px;"></td>
                                <td>
                                    <a href="" class="btn btn-info">Sửa</a>
                                    <a href="" class="btn btn-info">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên thương hiệu</th>
                            <th>Hình ảnh</th>
                            <th>Hoạt động</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
