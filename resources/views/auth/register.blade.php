@extends('layouts.client')



{{-- @section('content')
    <div class="fxt-content">
        <h2>Register for new account</h2>
        <div class="fxt-form">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <div class="fxt-transformY-50 fxt-transition-delay-1">
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                            name="name" placeholder="Name" required="required" value="{{ old('name') }}">

                    </div>

                </div>
                @error('name')
                    <p class="alert-danger">{{ $message }}</p>
                @enderror
                <div class="form-group">
                    <div class="fxt-transformY-50 fxt-transition-delay-1">
                        <input type="email" id="email" class="form-control  @error('email') is-invalid @enderror"
                            name="email" placeholder="Email" required="required" value="{{ old('email') }}">
                    </div>
                </div>
                @error('name')
                    <p class="alert-danger">{{ $message }}</p>
                @enderror
                <div class="form-group">
                    <div class="fxt-transformY-50 fxt-transition-delay-2">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="********" required="required">
                        <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                    </div>
                </div>
                @error('password')
                    <p class="alert-danger">{{ $message }}</p>
                @enderror
                <div class="form-group">
                    <div class="fxt-transformY-50 fxt-transition-delay-3">
                        <div class="fxt-checkbox-area">
                            <div class="checkbox">
                                <input id="checkbox1" type="checkbox">
                                <label for="checkbox1">Keep me logged in</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="fxt-transformY-50 fxt-transition-delay-4">
                        <button type="submit" class="fxt-btn-fill">Register</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="fxt-footer">
            <div class="fxt-transformY-50 fxt-transition-delay-9">
                <p>Already have an account?<a href="{{ route('login') }}" class="switcher-text2 inline-text">Log in</a></p>
            </div>
        </div>
    </div>
@endsection --}}




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
                                <li class="breadcrumb-item active" aria-current="page">login-Register</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- login register wrapper start -->
    <div class="login-register-wrapper section-padding">
        <div class="container" style="margin-left:30% ">
            
    <div class="col-lg-6">
        <div class="login-reg-form-wrap sign-up-form">
            <h5>Singup Form</h5>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="single-input-item">
                    <input id="name" class="@error('name') is-invalid @enderror" type="text" placeholder="Full Name"
                        name="name" required value="{{ old('name') }}" />
                    @error('name')
                        <p class="alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="single-input-item">
                    <input id="email" class="@error('email') is-invalid @enderror" type="email"
                        placeholder="Enter your Email" name="email" value="{{ old('email') }}" />
                    @error('name')
                        <p class="alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="single-input-item">
                            <input id="password" name="password" class="@error('password') is-invalid @enderror"
                                type="password" placeholder="Enter your Password" required />
                        </div>
                        @error('password')
                        <p class="alert-danger">{{ $message }}</p>
                    @enderror
                    </div>



{{-- 
                    <div class="col-lg-6">
                        <div class="single-input-item">
                            <input type="password" placeholder="Repeat your Password" required />
                        </div>
                    </div> --}}
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
<!-- login register wrapper end -->
</main>
@endsection
