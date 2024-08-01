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
                <div class="col-lg-6">
                    <div class="login-reg-form-wrap sign-up-form">
                        <h5>Singup Form</h5>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="single-input-item">
                                <input id="name" class="@error('name') is-invalid @enderror" type="text"
                                    placeholder="Full Name" name="name" required autocomplete="name" autofocus
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <p class="alert-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="single-input-item">
                                <input id="email" class="@error('email') is-invalid @enderror" type="email"
                                    placeholder="Enter your Email" name="email" value="{{ old('email') }}" required
                                    autocomplete="email" />
                                @error('email')
                                    <p class="alert-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="">
                                    <div class="single-input-item">
                                        <input id="password" name="password"
                                            class="@error('password') is-invalid @enderror" type="password"
                                            placeholder="Enter your Password" required autocomplete="new-password" />
                                    </div>
                                    @error('password')
                                        <p class="alert-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="">
                                    <div class="single-input-item">
                                        <input type="password" id="password-confirm" placeholder="Repeat your Password"
                                            name="password_confirmation" required autocomplete="new-password" />
                                    </div>
                                </div>
                            </div>
                            <div class="single-input-item">
                                <div class="login-reg-form-meta">
                                    <div class="remember-meta">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="subnewsletter">
                                            <label class="custom-control-label" for="subnewsletter">Subscribe
                                                Our Newsletter</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-input-item">
                                <button type="submit" class="btn btn-sqr">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
