@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Đơn hàng đã bị xóa mềm</h4>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    @if ($deletedDonHangs->isEmpty())
                                        <p>Không có đơn hàng nào đã bị xóa mềm.</p>
                                    @else
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Mã đơn hàng</th>
                                                    <th>Ngày đặt</th>
                                                    <th>Tổng tiền</th>
                                                    <th>Trang thái</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($deletedDonHangs as $donHang)
                                                    <tr>
                                                        <td>{{ $donHang->ma_don_hang }}</td>
                                                        <td>{{ $donHang->created_at->format('d-m-y') }}</td>
                                                        <td>{{ number_format($donHang->tong_tien, 0, '', '.') }} đ</td>
                                                        <td>{{ $trangThaiDonHang[$donHang->trang_thai_don_hang] ?? 'Không xác định' }}
                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('admins.donhangs.restore', $donHang->id) }}"
                                                                method="POST" style="display:inline-block;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success">Khôi
                                                                    phục</button>
                                                            </form>
                                                            <form
                                                                action="{{ route('admins.donhangs.force-delete', $donHang->id) }}"
                                                                method="POST" style="display:inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"
                                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn đơn hàng này?')">Xóa
                                                                    vĩnh viễn</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
