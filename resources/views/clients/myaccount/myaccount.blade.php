{{-- cap nhat khach hang --}}
@extends('layouts.client')

@section('css')
    <style>
        .section-bg-color {
            background-color: #f7f7f7;
            padding: 30px;
            border-radius: 10px;
        }

        .my-account-wrapper .row.justify-content-center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .my-account-wrapper .col-lg-6 {
            max-width: 600px;
        }

        .myaccount-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            /* Để căn chỉnh đúng cho ảnh */
        }

        .image-display {
            position: absolute;
            top: -50px;
            right: -50px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            background-color: #f0f0f0;
            /* Màu nền khi không có ảnh */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-display img {
            width: 100%;
            height: auto;
        }

        .image-display i {
            font-size: 50px;
            /* Kích thước biểu tượng */
            color: #ccc;
            /* Màu sắc biểu tượng */
        }
    </style>
@endsection

@section('content')
    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">my-account</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- my account wrapper start -->
        <div class="my-account-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <!-- Account Details Content Start -->
                            <div class="myaccount-content">
                                <h5>Account Details</h5>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <!-- Hiển thị hình ảnh đại diện -->
                                <div class="image-display">
                                    @if ($user->hinh_anh)
                                        <img id="profile-picture" src="{{ asset('storage/' . $user->hinh_anh) }}"
                                            alt="Profile Picture" />
                                    @else
                                        <i class="fa fa-user-circle"></i> <!-- Biểu tượng thay thế nếu không có ảnh -->
                                    @endif
                                </div>

                                <div class="account-details-form">
                                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="single-input-item">
                                                    <label for="name" class="required">Name</label>
                                                    <input type="text" id="name" name="name" placeholder="Name" value="{{ $user->name }}" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="single-input-item">
                                                    <label for="gender" class="required">Gender</label>
                                                    <select id="gender" name="gioi_tinh" class="form-select" required>
                                                        <option value="Nam" {{ $user->gioi_tinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                                                        <option value="Nữ" {{ $user->gioi_tinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                                        <option value="Khác" {{ $user->gioi_tinh == 'Khác' ? 'selected' : '' }}>Khác</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="single-input-item">
                                            <label for="avatar">Profile Picture</label>
                                            <input type="file" id="avatar" name="hinh_anh" onchange="previewImage(event)" />
                                            @if($user->hinh_anh)
                                                <div class="image-display">
                                                    <img src="{{ asset('storage/' . $user->hinh_anh) }}" alt="Profile Picture" id="profile-picture">
                                                </div>
                                            @else
                                                <p>Không có ảnh đại diện</p>
                                            @endif
                                        </div>
                                    
                                        <div class="single-input-item">
                                            <label for="email" class="required">Email Address</label>
                                            <input type="email" id="email" placeholder="Email Address" value="{{ $user->email }}" disabled />
                                        </div>
                                    
                                        <div class="single-input-item">
                                            <label for="address">Address</label>
                                            <input type="text" id="address" name="address" placeholder="Address" value="{{ $user->address }}"  />
                                        </div>
                                    
                                        <div class="single-input-item">
                                            <label for="phone">Phone Number</label>
                                            <input type="text" id="phone" name="phone" placeholder="Phone Number" value="{{ $user->phone }}"  />
                                        </div>
                                    
                                        <div class="single-input-item">
                                            <label for="dob">Date of Birth</label>
                                            <input type="date" id="dob" name="ngay_sinh" value="{{ $user->ngay_sinh }}" />
                                        </div>
                                    
                                        <fieldset>
                                            <legend>Password change</legend>
                                            <div class="single-input-item">
                                                <label for="current-pwd" class="required">Current Password</label>
                                                <input type="password" id="current-pwd" name="current_pwd" placeholder="Current Password" required />
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label for="new-pwd">New Password</label>
                                                        <input type="password" id="new-pwd" name="new_pwd" placeholder="New Password" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label for="confirm-pwd">Confirm Password</label>
                                                        <input type="password" id="confirm-pwd" name="new_pwd_confirmation" placeholder="Confirm Password" />
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    
                                        <div class="single-input-item">
                                            <button class="btn btn-sqr">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Account Details Content End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- my account wrapper end -->
    </main>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('profile-picture');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection