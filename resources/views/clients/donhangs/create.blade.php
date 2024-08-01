@extends('layouts.client')

@section('css')
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
                                    <li class="breadcrumb-item"><a href="shop.html">shop</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">checkout</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- checkout main wrapper start -->
        <div class="checkout-page-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Checkout Login Coupon Accordion Start -->
                        <div class="checkoutaccordion" id="checkOutAccordion">
                            <div class="card">
                                <h6>Returning Customer? <span data-bs-toggle="collapse"
                                        data-bs-target="#logInaccordion">Click
                                        Here To Login</span></h6>
                                <div id="logInaccordion" class="collapse" data-parent="#checkOutAccordion">
                                    <div class="card-body">
                                        <p>If you have shopped with us before, please enter your details in the boxes
                                            below. If you are a new customer, please proceed to the Billing &amp;
                                            Shipping section.</p>
                                        <div class="login-reg-form-wrap mt-20">
                                            <div class="row">
                                                <div class="col-lg-7 m-auto">
                                                    <form action="#" method="post">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="single-input-item">
                                                                    <input type="email" placeholder="Enter your Email"
                                                                        required />
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="single-input-item">
                                                                    <input type="password" placeholder="Enter your Password"
                                                                        required />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="single-input-item">
                                                            <div
                                                                class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                                                <div class="remember-meta">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input"
                                                                            id="rememberMe" required />
                                                                        <label class="custom-control-label"
                                                                            for="rememberMe">Remember
                                                                            Me</label>
                                                                    </div>
                                                                </div>

                                                                <a href="#" class="forget-pwd">Forget Password?</a>
                                                            </div>
                                                        </div>

                                                        <div class="single-input-item">
                                                            <button class="btn btn-sqr">Login</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <h6>Have A Coupon? <span data-bs-toggle="collapse" data-bs-target="#couponaccordion">Click
                                        Here To Enter Your Code</span></h6>
                                <div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion">
                                    <div class="card-body">
                                        <div class="cart-update-option">
                                            <div class="apply-coupon-wrapper">
                                                <form action="#" method="post" class=" d-block d-md-flex">
                                                    <input type="text" placeholder="Enter Your Coupon Code" required />
                                                    <button class="btn btn-sqr">Apply Coupon</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Checkout Login Coupon Accordion End -->
                    </div>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('donhangs.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Checkout Billing Details -->
                        <div class="col-lg-6">
                            <div class="checkout-billing-details-wrap">
                                <h5 class="checkout-title">Billing Details</h5>
                                <div class="billing-form-wrap">


                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <div class="single-input-item">
                                        <label for="name" class="required">Tên người nhận</label>
                                        <input type="text" name="ten_nguoi_nhan" placeholder="Nhập tên người nhận"
                                            value="{{ Auth::user()->name }}" />


                                        @error('ten_nguoi_nhan')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="single-input-item">
                                        <label for="email_nguoi_nhan" class="required">Email Address</label>
                                        <input type="email" name="email_nguoi_nhan" placeholder="Email Address"
                                            value="{{ Auth::user()->email }}" />

                                        @error('email_nguoi_nhan')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="single-input-item">
                                        <label for="so_dien_thoai_nguoi_nhan" class="required">Số điện thoại người
                                            nhận</label>
                                        <input type="text" name="so_dien_thoai_nguoi_nhan" placeholder="phone"
                                            value="{{ Auth::user()->phone }}" />

                                        @error('email_nguoi_nhan')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="single-input-item">
                                        <label for="dia_chi_nguoi_nhan" class="required">Số điện thoại người nhận</label>
                                        <input type="text" name="dia_chi_nguoi_nhan" placeholder="Dia chi"
                                            value="{{ Auth::user()->address }}" />

                                        @error('dia_chi_nguoi_nhan')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="single-input-item">
                                        <label for="gi_chu">Ghi chú</label>
                                        <textarea name="gi_chu" id="ordernote" cols="30" rows="3" placeholder="Nhập ghi chú"></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Order Summary Details -->
                        <div class="col-lg-6">
                            <div class="order-summary-details">
                                <h5 class="checkout-title">Your Order Summary</h5>
                                <div class="order-summary-content">
                                    <!-- Order Summary Table -->
                                    <div class="order-summary-table table-responsive text-center">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Products</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($carts as $key => $item)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('details', $key) }}">
                                                                {{ $item['ten_san_pham'] }}<strong> x
                                                                    {{ $item['so_luong'] }}</strong></a>
                                                        </td>
                                                        <td>{{ number_format($item['gia'] * $item['so_luong'], 0, '', '.') }}
                                                            đ
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td>Sub Total</td>
                                                    <td>
                                                        <strong>{{ number_format($subTotal, 0, '', '.') }} đ</strong>
                                                        <input type="hidden" name="tien_hang"
                                                            value="{{ $subTotal }}">
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Shipping</td>

                                                    <td><strong>{{ number_format($shipping, 0, '', '.') }} đ</strong>
                                                        <input type="hidden" name="tien_ship"
                                                            value="{{ $shipping }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Total Amount</td>
                                                    <td><strong>{{ number_format($total, 0, '', '.') }} đ</strong>
                                                        <input type="hidden" name="tong_tien"
                                                            value="{{ $total }}">
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- Order Payment Method -->
                                    <div class="order-payment-method">
                                        <div class="single-payment-method show">
                                            <div class="payment-method-name">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="cashon" value="cash"
                                                        class="custom-control-input" checked />
                                                    <label class="custom-control-label" for="cashon">Cash On
                                                        Delivery</label>
                                                </div>
                                            </div>
                                            <div class="payment-method-details" data-method="cash">
                                                <p>Pay with cash upon delivery.</p>
                                            </div>
                                           
                                            
                                        </div>

                                        <div class="summary-footer-area">
                                            <button type="submit" class="btn btn-sqr">Place Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>

                <form action="{{ route('qrpayment.generate') }}" method="POST">
                    @csrf
                    <input type="number" name="amount" placeholder="Enter Amount" required>
                    <button type="submit" class="btn btn-sqr">Generate QR Code</button>
                </form>
            </div>
        </div>
        </div>
        <!-- checkout main wrapper end -->
    </main>
@endsection


@section('js')
@endsection
