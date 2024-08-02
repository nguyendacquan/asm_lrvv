@extends('layouts.admin')


@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">

                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="fs-18 fw-semibold m-0">Quản lý đơn hàng</h4>
                        </div>
                        <a href="{{ route('admins.donhangs.deleted') }}" class="btn btn-warning">Xem đơn hàng đã xóa mềm</a>
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

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Ngày đặt</th>
                                            <th>Tổng tiền</th>
                                            <th>Trang thái</th>
                                            <th>Hành động</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($listdonHang as $item)
                                            <tr>
                                                <td>{{ $item->ma_don_hang }}</td>
                                                <td>{{ $item->created_at->format('d-m-y') }}</td>

                                                <td>{{ number_format($item->tong_tien, 0, '', '.') }} đ</td>
                                                <td>
                                                    <form action="{{ route('admins.donhangs.update', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <select name="trang_thai_don_hang" class="form-select"
                                                            onchange="confirmSubmit(this)"
                                                            data-default-value="{{ $item->trang_thai_don_hang }}">
                                                            @foreach ($trangThaiDonHang as $key => $value)
                                                                <option
                                                                    value="{{ $key }}"{{ $key == $item->trang_thai_don_hang ? 'selected' : '' }}
                                                                    {{ $key == $type_huy_don_hang? 'disabled' : '' }}>
                                                                    {{ $value }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </form>
                                                </td>

                                                <td>
                                                    <a href="{{ route('admins.donhangs.show', $item->id) }}">
                                                        <i
                                                            class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                    </a>


                                                  
                                                        <form action="{{ route('admins.donhangs.destroy', $item->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Bạn có muốn xóa không')"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="border-0 bg-white">
                                                                <i
                                                                    class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i>
                                                            </button>
                                                        </form>
                                                    
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
@endsection


@section('js')
    <script>
        function confirmSubmit(selectElement) {
            var form = selectElement.form;
            var selectedOption = selectElement.options[selectElement.selectedIndex].text;
            var defaultValue = selectElement.getAttribute('data-default-value');
            if (confirm('Bạn có muốn thay đổi trang thái đơn hàng thành "' + selectedOption + '" không ?')) {
                form.submit();
            } else {
                selectElement.value = defaultValue;
            }

        }
    </script>
@endsection
