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
                                            <th scope="">Thao Tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listUser as $item)
                                            </tr>
                                            @if ($item->role !== 'Admin')
                                                <tr>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->phone }}</td>
                                                    <td>{{ $item->address }}</td>
                                                    <td>{{ $item->role }}</td>
                                                    <td class="d-flex">
                                                        <a href="{{ route('admins.users.edit', $item->id) }}"><i
                                                                class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                        </a>
                                                        <form action="{{ route('admins.users.destroy', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="border-0 bg-white">
                                                                <i
                                                                    class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1">
                                                                </i>
                                                            </button>
                                                        </form>
                                                    </td>
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
