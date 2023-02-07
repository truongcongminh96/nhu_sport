@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Danh sách loại sản phẩm phụ</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách loại sản phẩm phụ</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Cài đặt</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown"><span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                        <a class="dropdown-item" href="{{ route('add.subcategory') }}">Thêm loại sản phẩm phụ</a>
                        <a class="dropdown-item" href="">Another action</a>
                        <a class="dropdown-item" href="">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="">Separated link</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Danh sách loại sản phẩm phụ</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên loại sản phẩm</th>
                            <th>Tên loại sản phẩm phụ</th>
                            <th>Hoạt động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subCategories as $key => $subCategory)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $subCategory['category']['category_name'] }}</td>
                                <td>{{ $subCategory->subcategory_name }}</td>
                                <td>
                                    <a href="{{ route('edit.category', $subCategory->id) }}" class="btn btn-info">Sửa</a>
                                    <a href="{{ route('delete.category', $subCategory->id) }}" class="btn btn-danger" id="delete">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên loại sản phẩm</th>
                            <th>Tên loại sản phẩm phụ</th>
                            <th>Hoạt động</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
