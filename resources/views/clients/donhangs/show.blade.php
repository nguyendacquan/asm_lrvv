@extends('layouts.client')

@section('content')
    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">my-account</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <!-- my account wrapper start -->
        <div class="my-account-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- My Account Page Start -->
                            <div class="myaccount-page-wrapper">
                                <!-- My Account Tab Menu Start -->
                                <div class="row">

                                    <div class="col-lg-9 col-md-8">
                                        <div class="tab-content" id="myaccountContent">
                                            <!-- Single Tab Content Start -->
                                            <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h5>Thông tin đơn hàng: <span>{{ $donHang->ma_don_hang }}</span></h5>
                                                    <div class="welcome">
                                                        <p>Tên người nhận: <strong>{{ $donHang->ten_nguoi_nhan }}</strong>
                                                        </p>
                                                        <p>Email người nhận:
                                                            <strong>{{ $donHang->email_nguoi_nhan }}</strong></p>
                                                        <p>Số điện thoại người nhận:
                                                            <strong>{{ $donHang->so_dien_thoai_nguoi_nhan }}</strong></p>
                                                        <p>Địa chỉ người nhận:
                                                            <strong>{{ $donHang->dia_chi_nguoi_nhan }}</strong></p>
                                                        <p>Ngày đặt hàng:
                                                            <strong>{{ $donHang->created_at->format('d-m-Y') }}</strong></p>
                                                        <p>Ghi chú: <strong>{{ $donHang->ghi_chu }}</strong></p>
                                                        <p>Trạng thái đơn hàng:
                                                            <strong>{{ $trangThaiDonHang[$donHang->trang_thai_don_hang] }}</strong>
                                                        </p>
                                                        <p>Trạng thái thanh toán:
                                                            <strong>{{ $trangThaiThanhToan[$donHang->trang_thai_thanh_toan] }}</strong>
                                                        </p>
                                                        <p>Tiền hàng:
                                                            <strong>{{ number_format($donHang->tien_hang, 0, '', '.') }}
                                                                đ</strong></p>
                                                        @if (session()->has('coupon'))
                                                            <p>Giảm giá ({{ session('coupon')['code'] }}):
                                                                <strong>-{{ number_format(session('coupon')['discount'], 0, '', '.') }}
                                                                    đ</strong>
                                                            </p>
                                                        @endif
                                                        <p>Tiền ship:
                                                            <strong>{{ number_format($donHang->tien_ship, 0, '', '.') }}
                                                                đ</strong></p>
                                                        <p>Tổng tiền:
                                                            <strong>{{ number_format($donHang->tong_tien, 0, '', '.') }}
                                                                đ</strong></p>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5>Orders</h5>
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
                                                                    <td><img width="100px"
                                                                            src="{{ url('storage/', $sanPham->hinh_anh) }}"
                                                                            alt=""></td>
                                                                    <td>{{ $sanPham->ma_san_pham }}</td>
                                                                    <td>{{ $sanPham->ten_san_pham }}</td>
                                                                    <td>{{ number_format($item->don_gia, 0, '', '.') }} đ
                                                                    </td>
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
                </div>
            </div>
        </div>
    </main>
@endsection
