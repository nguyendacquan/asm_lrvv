@extends('layouts.admin')
@section('css')
    <style>
        /* custom.css */
        .card {
            border-radius: 0.5rem;
        }

        .card-header {
            border-bottom: 2px solid #ddd;
        }

        .img-fluid {
            max-height: 200px;
            object-fit: cover;
        }

        .table {
            margin-top: 20px;
        }

        .table thead {
            background-color: #343a40;
            color: #fff;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    </style>
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Quản lý bình luận</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2>Thông tin sản phẩm</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('storage/' . $sanPham->hinh_anh) }}" alt="{{ $sanPham->ten_san_pham }}" class="img-fluid rounded mb-3">
                    </div>
                    <div class="col-md-8">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Mã sản phẩm:</strong> {{ $sanPham->ma_san_pham }}</li>
                            <li class="list-group-item"><strong>Tên sản phẩm:</strong> {{ $sanPham->ten_san_pham }}</li>
                            <li class="list-group-item"><strong>Giá sản phẩm:</strong> {{ number_format($sanPham->gia_san_pham) }} VND</li>
                            <li class="list-group-item"><strong>Giá khuyến mãi:</strong> {{ number_format($sanPham->gia_khuyen_mai) }} VND</li>
                            <li class="list-group-item"><strong>Mô tả ngắn:</strong> {{ $sanPham->mo_ta_ngan }}</li>
                            <li class="list-group-item"><strong>Nội dung:</strong> {{ $sanPham->noi_dung }}</li>
                            <li class="list-group-item"><strong>Số lượng:</strong> {{ $sanPham->so_luong }}</li>
                            <li class="list-group-item"><strong>Lượt xem:</strong> {{ $sanPham->luot_xem }}</li>
                            <li class="list-group-item"><strong>Danh mục ID:</strong> {{ $sanPham->danh_muc_id }}</li>
                            <li class="list-group-item"><strong>Trạng thái:</strong> <span class="badge {{ $sanPham->is_type == 1 ? 'bg-success' : 'bg-secondary' }}">{{ $sanPham->is_type == 1 ? 'Hiển thị' : 'Ẩn' }}</span></li>
                            <li class="list-group-item"><strong>New:</strong> <span class="badge {{ $sanPham->is_new == 1 ? 'bg-success' : 'bg-secondary' }}">{{ $sanPham->is_new == 1 ? 'Hiển thị' : 'Ẩn' }}</span></li>
                            <li class="list-group-item"><strong>Hot:</strong> <span class="badge {{ $sanPham->is_hot == 1 ? 'bg-success' : 'bg-secondary' }}">{{ $sanPham->is_hot == 1 ? 'Hiển thị' : 'Ẩn' }}</span></li>
                            <li class="list-group-item"><strong>Hot Deal:</strong> <span class="badge {{ $sanPham->is_hot_deal == 1 ? 'bg-success' : 'bg-secondary' }}">{{ $sanPham->is_hot_deal == 1 ? 'Hiển thị' : 'Ẩn' }}</span></li>
                            <li class="list-group-item"><strong>Show Home:</strong> <span class="badge {{ $sanPham->is_show_home == 1 ? 'bg-success' : 'bg-secondary' }}">{{ $sanPham->is_show_home == 1 ? 'Hiển thị' : 'Ẩn' }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5 shadow-sm">
            <div class="card-header bg-success text-white">
                <h2>Bình luận sản phẩm</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Tên người dùng</th>
                                <th>Nội dung</th>
                                <th>Đánh giá</th>
                                <th>Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sanPham->binhLuans as $binhLuan)
                                <tr>
                                    <td>{{ $binhLuan->nguoiDung->name }}</td>
                                    <td>{{ $binhLuan->noi_dung }}</td>
                                    <td>{{ $binhLuan->danh_gia }}</td>
                                    <td>{{ $binhLuan->created_at->format('d M, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection
