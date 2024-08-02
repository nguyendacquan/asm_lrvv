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
                                    <li class="breadcrumb-item active" aria-current="page">my-account</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="my-account-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="myaccount-content col-lg-6">
                            <h5>Detail User</h5>
                            <address>
                                <p><strong>Name: {{ Auth::user()->name }}</strong></p>
                                <p><strong>Email: {{ Auth::user()->email }}</strong></p>
                                <p><strong>Mobile: {{ Auth::user()->phone }}</strong></p>
                                <p><strong>Address: {{ Auth::user()->address }}</strong></p>
                            </address>
                            <a href="{{ route('myEdit', ['id' => $user->id]) }}" class="btn btn-sqr"><i
                                    class="fa fa-edit"></i>
                                Edit Address</a>
                        </div>
                        {{-- <div class="myaccount-content col-lg-6">
                            <h5>Password Edit</h5>
                            <a href="{{ route('myEdit', ['id' => $user->id]) }}" class="btn btn-sqr"><i
                                    class="fa fa-edit"></i>
                                Edit Address</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
