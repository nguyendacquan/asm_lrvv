@extends('layouts.admin')


@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lý đơn hàng</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>

                                <tr>
                                    <th>Thông tin tài khoản đặt hàng</th>
                                    <th>Thông tin người nhận hàng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <ul>
                                            <li>Tên tài khoản: {{ $donHang->user->name }}</li>
                                            <li>Email: {{ $donHang->user->email }}</li>
                                            <li>Số điện thoại: {{ $donHang->user->phone }}</li>
                                            <li>Địa chỉ: {{ $donHang->user->address }}</li>
                                            <li>Tài khoản: {{ $donHang->user->role }}</li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            <h5>Thông tin đơn hàng: <span>{{ $donHang->ma_don_hang }}</span></h5>
                                            <div class="welcome">
                                                <p>Tên người nhận: <strong>{{ $donHang->ten_nguoi_nhan }}</strong>
                                                </p>
                                                <p>Email người nhận:
                                                    <strong>{{ $donHang->email_nguoi_nhan }}</strong>
                                                </p>
                                                <p>Số điện thoại người nhận:
                                                    <strong>{{ $donHang->so_dien_thoai_nguoi_nhan }}</strong>
                                                </p>
                                                <p>Địa chỉ người nhận:
                                                    <strong>{{ $donHang->dia_chi_nguoi_nhan }}</strong>
                                                </p>
                                                <p>Ngày đặt hàng:
                                                    <strong>{{ $donHang->created_at->format('d-m-y') }}</strong>
                                                </p>
                                                <p>Ghi chú: <strong>{{ $donHang->gi_chu }}</strong></p>
                                                <p>Trạng thái đơn hàng:
                                                    <strong>{{ $trangThaiDonHang[$donHang->trang_thai_don_hang] }}</strong>
                                                </p>
                                                <p>Trạng thái thanh toán:
                                                    <strong>{{ $trangThaiThanhToan[$donHang->trang_thai_thanh_toan] }}</strong>
                                                </p>
                                                <p>Tiền hàng:
                                                    <strong>{{ number_format($donHang->tien_hang, 0, '', '.') }}
                                                        đ</strong>
                                                </p>
                                                <p>Tiền ship:
                                                    <strong>{{ number_format($donHang->tien_ship, 0, '', '.') }}
                                                        đ</strong>
                                                </p>
                                                <p>Tổng tiền:
                                                    <strong>{{ number_format($donHang->tong_tien, 0, '', '.') }}
                                                        đ</strong>
                                                </p>

                                            </div>
                                        </ul>
                                    </td>

                                </tr>
                            </tbody>
                        </table>


                        <div class="card-header">
                            <h5 class="card-title mb-0"></h5>
                        </div>
                        <div class="myaccount-table table-responsive text-center">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donHang->chiTietDonHang as $item)
                                        @php
                                            $sanPham = $item->sanPham;
                                        @endphp
                                        <tr>
                                            <td><img width="100px" src="{{ url('storage/', $sanPham->hinh_anh) }}"
                                                    alt=""></td>
                                            <td>{{ $sanPham->ma_san_pham }}</td>
                                            <td>{{ $sanPham->ten_san_pham }}</td>
                                            <td>{{ number_format($item->don_gia, 0, '', '.') }} đ</td>
                                            <td>{{ $item->so_luong }}</td>
                                            <td>{{ $item->thanh_tien }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div> <!-- container-fluid -->
    </div>
@endsection


@section('js')
@endsection
