@extends('layouts.client')

@section('css')
    <style>
        .center-screen {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .center-content {
            max-width: 600px;
            width: 100%;
            position: relative;
        }

        .profile-img-container {
            position: absolute;
            top: -50px;
            right: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100px;
            height: 100px;
            overflow: hidden;
            border-radius: 50%;
            border: 2px solid #ccc;
            background-color: #fff;
        }

        .profile-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-img-container i {
            font-size: 3rem;
            color: #ccc;
        }

        .myaccount-content {
            padding-top: 60px;
        }

        .error-message {
            color: red;
            font-size: 0.875rem;
        }
    </style>
@endsection

@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('client.index') }}"><i
                                            class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">My Account</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-account-wrapper section-padding">
        <div class="container center-screen">
            <div class="section-bg-color center-content">
                <div class="profile-img-container">
                    @if ($user->hinh_anh)
                        <img src="{{ asset('storage/' . $user->hinh_anh) }}" alt="Profile Image">
                    @else
                        <i class="fa fa-user"></i>
                    @endif
                </div>
                <div class="myaccount-page-wrapper">
                    <div class="myaccount-content">
                        <h5>Account Details</h5>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="account-details-form">
                            <form action="{{ route('account.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <label for="name" class="required">Name</label>
                                            <input type="text" id="name" name="name"
                                                value="{{ old('name', $user->name) }}" />
                                            @error('name')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <label for="email" class="required">Email Address</label>
                                            <input type="email" id="email" name="email"
                                                value="{{ old('email', $user->email) }}" readonly/>
                                            @error('email')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="single-input-item">
                                    <label for="dia_chi" class="required">Address</label>
                                    <input type="text" id="dia_chi" name="dia_chi"
                                        value="{{ old('dia_chi', $user->dia_chi) }}" />
                                    @error('dia_chi')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="single-input-item">
                                    <label for="ngay_sinh" class="required">Date of Birth</label>
                                    <input type="date" id="ngay_sinh" name="ngay_sinh"
                                        value="{{ old('ngay_sinh', $user->ngay_sinh ? $user->ngay_sinh->format('Y-m-d') : '') }}" />
                                    @error('ngay_sinh')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="single-input-item">
                                    <label for="so_dien_thoai" class="required">Phone Number</label>
                                    <input type="text" id="so_dien_thoai" name="so_dien_thoai"
                                        value="{{ old('so_dien_thoai', $user->so_dien_thoai) }}" />
                                    @error('so_dien_thoai')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="single-input-item">
                                    <label for="hinh_anh" class="required">Profile Image</label>
                                    <input type="file" id="hinh_anh" name="hinh_anh" />
                                    @error('hinh_anh')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="single-input-item">
                                    <label for="gioi_tinh" class="required">Gender</label>
                                    <select id="gioi_tinh" name="gioi_tinh">
                                        <option value="Nam"
                                            {{ old('gioi_tinh', $user->gioi_tinh) == 'Nam' ? 'selected' : '' }}>Nam</option>
                                        <option value="Nữ"
                                            {{ old('gioi_tinh', $user->gioi_tinh) == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                        <option value="Khác"
                                            {{ old('gioi_tinh', $user->gioi_tinh) == 'Khác' ? 'selected' : '' }}>Khác
                                        </option>
                                    </select>
                                </div>
                                <div class="single-input-item">
                                    <label for="trang_thai" class="required">Status</label>
                                    <select id="trang_thai" name="trang_thai" disabled>
                                        <option value="1"
                                            {{ old('trang_thai', $user->trang_thai) == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0"
                                            {{ old('trang_thai', $user->trang_thai) == '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                    @error('trang_thai')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <legend>Password change</legend>
                                <div class="single-input-item">
                                    <label for="current-pwd" class="required">Current Password</label>
                                    <input type="password" id="current-pwd" name="current_password"
                                        placeholder="Current Password" />
                                    @error('current_password')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <label for="new-pwd" class="required">New Password</label>
                                            <input type="password" id="new-pwd" name="password"
                                                placeholder="New Password" />
                                            @error('password')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <label for="confirm-pwd" class="required">Confirm Password</label>
                                            <input type="password" id="confirm-pwd" name="password_confirmation"
                                                placeholder="Confirm Password" />
                                            @error('password_confirmation')
                                                <div class="error-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="single-input-item">
                                    <button class="btn btn-sqr">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
@endsection