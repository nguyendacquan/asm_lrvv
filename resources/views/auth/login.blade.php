@extends('layouts.client')
@section('content')
    <main>
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">login-Register</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="login-register-wrapper section-padding">
            <div class="container" style="margin-left:30% ">
                <div class="member-area-from-wrap">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="login-reg-form-wrap">
                                <h5>Sign In</h5>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="single-input-item">
                                        <input type="email" name="email" id="email"
                                            class=" @error('email') is-invalid @enderror" placeholder="Email or Username"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus />
                                        @error('email')
                                            <p class="alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="single-input-item">
                                        <input type="password" name="password"
                                            class="@error('password') is-invalid @enderror"
                                            placeholder="Enter your Password" required autocomplete="current-password" />
                                        @error('password')
                                            <p class="alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="single-input-item">
                                        <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                            <div class="remember-meta">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="rememberMe">
                                                    <label class="custom-control-label" for="rememberMe">Remember Me</label>
                                                </div>
                                            </div>
                                            @if (Route::has('password.request'))
                                                <a style="color: black" class="forget-pwd"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="single-input-item">
                                            <button type="submit" class="btn btn-sqr">Login</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
