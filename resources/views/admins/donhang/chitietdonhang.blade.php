@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Chi Tiết Đơn Hàng #{{ $donHang->id }}</h1>
            <a href="{{ route('admins.donhang') }}" class="btn btn-primary"><i data-feather='arrow-left'></i></a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h2>Thông Tin Khách Hàng</h2>
                    </div>
                    <div class="card-body">
                        <p><strong>Khách Hàng:</strong> {{ $donHang->user->name }}</p>
                        <p><strong>Ngày Đặt Hàng:</strong> {{ $donHang->ngay_dat_hang }}</p>
                        <p><strong>Trạng Thái:</strong>
                        <form action="{{ route('admins.capnhatdonhang', $donHang->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="trang_thai" class="form-control" onchange="this.form.submit()">
                                <option value="Đang xử lý" {{ $donHang->trang_thai == 'Đang xử lý' ? 'selected' : '' }}>Đang
                                    xử lý</option>
                                <option value="Đã giao" {{ $donHang->trang_thai == 'Đã giao' ? 'selected' : '' }}>Đã giao
                                </option>
                                <option value="Hủy" {{ $donHang->trang_thai == 'Hủy' ? 'selected' : '' }}>Hủy</option>
                            </select>
                        </form>
                        </p>
                        <p><strong>Tổng Tiền:</strong> {{ number_format($donHang->tong_tien, 0, ',', '.') }} VND</p>
                        <p><strong>Địa Chỉ Giao Hàng:</strong> {{ $donHang->dia_chi_giao_hang }}</p>
                        <p><strong>Phương Thức Thanh Toán:</strong> {{ $donHang->phuong_thuc_thanh_toan }}</p>
                        <p><strong>Chi Phí Vận Chuyển:</strong>
                            {{ number_format($donHang->chi_phi_van_chuyen, 0, ',', '.') }} VND</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Chi Tiết Sản Phẩm</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã Sản Phẩm</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Số Lượng</th>
                                    <th>Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donHang->chiTietDonHangs as $chiTiet)
                                    <tr>
                                        <td>{{ $chiTiet->sanPham->ma_san_pham }}</td>
                                        <td>{{ $chiTiet->sanPham->ten_san_pham }}</td>
                                        <td>{{ $chiTiet->so_luong }}</td>
                                        <td>{{ number_format($chiTiet->gia, 0, ',', '.') }} VND</td>
                                    </tr>
                                    <tr>
                                        <th>Hình ảnh sản phẩm</th>
                                        <td colspan="3"><img
                                                src="{{ asset('storage/' . $chiTiet->sanPham->hinh_anh) }}"
                                                alt="" width="100"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
