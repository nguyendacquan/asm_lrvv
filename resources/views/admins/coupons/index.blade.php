@extends('layouts.admin')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lý Mã Giảm Giá</h4>
                </div>
                <a href="{{ route('admins.coupons.create') }}" class="btn btn-primary">Create Coupon</a>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Danh sách Mã Giảm Giá</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Code</th>
                                        <th>Discount</th>
                                        <th>Expires At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $coupon)
                                        <tr>
                                            <td>{{ $coupon->id }}</td>
                                            <td>{{ $coupon->code }}</td>
                                            <td>{{ $coupon->discount }}</td>
                                            <td>{{ $coupon->expires_at }}</td>
                                            <td>
                                                <a href="{{ route('admins.coupons.edit', $coupon->id) }}" class="btn btn-warning">Edit</a>
                                                <form action="{{ route('admins.coupons.destroy', $coupon->id) }}" method="POST" style="display:inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
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
        </div> <!-- container-fluid -->
    </div>
@endsection
