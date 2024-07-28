@extends('layouts.admin')


@section('content')
    <div class="content">
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Danh sách liên hệ</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
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
                                            <th scope="col">Họ và tên</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Số điện thoại</th>
                                            <th scope="col">Lời nhắn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listLienHe as $item)
                                            <tr>
                                                <td>{{ $item->ho_va_ten }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->so_dien_thoai }}</td>
                                                <td>
                                                   <a href="">Xem chi tiết</a>
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
        </div>
    </div>
@endsection
