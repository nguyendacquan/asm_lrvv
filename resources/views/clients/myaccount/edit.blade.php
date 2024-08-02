@extends('layouts.client')




@section('content')
    <main>
        <div class="my-account-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="myaccount-content">
                            <h5>Account Details</h5>
                            <div class="account-details-form">
                                <form action="{{ route('myUpdate', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="single-input-item">
                                                <label for="name" class="required">Họ và tên</label>
                                                <input type="text" name="name" placeholder="Họ và tên"
                                                    value="{{ Auth::user()->name }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="single-input-item">
                                                <label for="phone" class="required">Số điện thoại</label>
                                                <input type="text" name="phone" placeholder="Số điệnt hoại"
                                                    value="{{ Auth::user()->phone }}" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="single-input-item">
                                                <label for="email" class="required">Email</label>
                                                <input type="text" name="email" placeholder="Email"
                                                    value="{{ Auth::user()->email }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="single-input-item">
                                                <label for="address" class="required">Địa chỉ</label>
                                                <input type="text" name="address"
                                                    placeholder="Địa chỉ"value="{{ Auth::user()->address }}" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="single-input-item">
                                        <button class="btn btn-sqr" type="submit">Save Changes</button>
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
