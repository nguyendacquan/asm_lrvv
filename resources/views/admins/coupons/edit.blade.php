@extends('layouts.admin')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Sửa Mã Giảm Giá</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Sửa Mã Giảm Giá</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admins.coupons.update', $coupon->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="code" class="form-label">Code</label>
                                            <input type="text" id="code" name="code"
                                                class="form-control @error('code') is-invalid @enderror"
                                                value="{{ old('code', $coupon->code) }}" placeholder="Code">
                                            @error('code')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="discount" class="form-label">Discount</label>
                                            <input type="text" id="discount" name="discount"
                                                class="form-control @error('discount') is-invalid @enderror"
                                                value="{{ old('discount', $coupon->discount) }}" placeholder="Discount">
                                            @error('discount')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="expires_at" class="form-label">Expires At</label>
                                            <input type="datetime-local" id="expires_at" name="expires_at"
                                                class="form-control @error('expires_at') is-invalid @enderror"
                                                value="{{ old('expires_at', $coupon->expires_at ? $coupon->expires_at->format('Y-m-d\TH:i') : '') }}">
                                            @error('expires_at')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary justify-content-center">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
@endsection
