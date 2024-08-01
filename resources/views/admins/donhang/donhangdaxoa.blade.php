@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Đơn hàng đã bị xóa mềm</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Khách Hàng</th>
                                            <th scope="col">Ngày Đặt Hàng</th>
                                            <th scope="col">Trạng Thái</th>
                                            <th scope="col">Tổng Tiền</th>
                                            <th scope="col">Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($donHangs as $donHang)
                                            <tr>
                                                <th scope="row">{{ $donHang->id }}</th>
                                                <td>{{ $donHang->user->name }}</td>
                                                <td>{{ $donHang->ngay_dat_hang }}</td>
                                                <td>{{ $donHang->trang_thai }}</td>
                                                <td>{{ number_format($donHang->tong_tien, 0, ',', '.') }} VND</td>
                                                <td>
                                                    <form action="{{ route('admins.donhang.restore', $donHang->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-success btn-sm">Khôi Phục</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $donHangs->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
