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
                                    <li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
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
                                <h5>Forgot Password</h5>
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="single-input-item">
                                        <input type="email" name="email" id="email"
                                            class=" @error('email') is-invalid @enderror" placeholder="Email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus />
                                      
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="single-input-item">
                                        <button type="submit" class="btn btn-sqr">Send Password Reset Link</button>
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
