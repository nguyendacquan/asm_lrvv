@extends('layouts.admin')


@section('content')
    <div class="content">
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Danh sách user</h4>
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
                                            <th scope="">Họ và tên</th>
                                            <th scope="">Email</th>
                                            <th scope="">Số điện thoại</th>
                                            <th scope="">Địa chỉ</th>
                                            <th scope="">Chức vụ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listUser as $item)
                                            </tr>
                                            @if ($item->role !== 'Admin')
                                                <tr>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->so_dien_thoai }}</td>
                                                    <td>{{ $item->dia_chi }}</td>
                                                    <td>{{ $item->role }}</td>
                                                </tr>
                                            @endif
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
