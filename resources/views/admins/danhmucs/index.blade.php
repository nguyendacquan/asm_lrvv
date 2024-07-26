@extends('layouts.admin')


@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lý dang mục sản phẩm</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title align-content-center mb-0">{{ $title }}</h5>

                            <a href="{{ route('admins.danhmucs.create') }}" class="btn btn-success"><i
                                    data-feather="plus-square"></i> Thêm danh mục</a>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Tên danh mục</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($listDanhMuc as $index => $item)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td><img style="border-radius: 4px" width="150px"
                                                        src="{{ url('storage/', $item->hinh_anh) }}"
                                                        alt="Hình ảnh danh mục"></td>
                                                <td>{{ $item->ten_danh_muc }}</td>
                                                <td
                                                    class="{{ $item->trang_thai == true ? 'text-success' : 'text-danger' }}">
                                                    {{ $item->trang_thai == true ? 'Hiển Thị' : 'Ẩn' }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admins.danhmucs.edit', $item->id) }}"><i
                                                            class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                    </a>
                                                    <form action="{{ route('admins.danhmucs.destroy', $item->id) }}"
                                                        method="POST" onsubmit="return confirm('Bạn có muốn xóa không')"
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
