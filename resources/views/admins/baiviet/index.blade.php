@extends('layouts.admin')


@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lý bài viết</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title align-content-center mb-0">{{ $title }}</h5>

                            <a href="{{ route('admins.baiviet.create') }}" class="btn btn-success"><i
                                    data-feather="plus-square"></i> Thêm bài viết</a>
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
                                            <th scope="col">Tiêu đề</th>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Sản phẩm</th>
                                            <th scope="col">Ngày nhập</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($listbaiviet as $index => $item)
                                            <tr>
                                                <th scope="row">{{ $index+1 }}</th>
                                                <th scope="row">{{ $item->tieu_de }}</th>
                                                <td>
                                                    <img style="border-radius: 4px" width="150px"
                                                        src="{{ url('storage/', $item->hinh_anh) }}"
                                                        alt="Hình ảnh bài viết">
                                                </td>
                                                <td>{{ $item->sanphamm->ten_san_pham }}</td>
                                                <td>{{ $item->ngay_nhap }}</td>
                                                <td>
                                                    <a href="{{ route('admins.baiviet.edit', $item->id) }}"><i
                                                            class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                    </a>
                                                    <form action="{{ route('admins.baiviet.destroy', $item->id) }}"
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
