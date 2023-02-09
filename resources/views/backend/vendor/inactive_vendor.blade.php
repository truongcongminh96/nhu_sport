@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Danh sách Inactive Vendor</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Inactive Vendor</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Danh sách Inactive Vendor</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên cửa hàng</th>
                            <th>Vendor username</th>
                            <th>Join date</th>
                            <th>Vendor email</th>
                            <th>Status</th>
                            <th>Hoạt động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($inactiveVendor as $key => $vendor)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $vendor->username }}</td>
                                <td>{{ $vendor->vendor_join }}</td>
                                <td>{{ $vendor->email }}</td>
                                <td><span class="btn btn-secondary">{{ $vendor->status }}</span></td>
                                <td>
                                    <a href="{{ route('inactive.vendor.details', $vendor->id) }}"
                                       class="btn btn-info">Vendor details</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên cửa hàng</th>
                            <th>Vendor username</th>
                            <th>Join date</th>
                            <th>Vendor email</th>
                            <th>Status</th>
                            <th>Hoạt động</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
