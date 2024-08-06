@extends('layouts.client')

@section('css')
<style>
    /* Your custom CSS */
    .alert {
        margin-top: 1rem;
    }
    .cart-calculator-wrapper {
        border: 1px solid #ddd;
        padding: 1rem;
        background-color: #f9f9f9;
    }
    .cart-table .pro-remove button {
        border: none;
        background: transparent;
        color: #dc3545;
        cursor: pointer;
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
                                <li class="breadcrumb-item"><a href="shop.html">shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">cart</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('cart.update') }}" method="POST">
                            @csrf
                            <!-- Cart Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">Thumbnail</th>
                                            <th class="pro-title">Product</th>
                                            <th class="pro-price">Price</th>
                                            <th class="pro-quantity">Quantity</th>
                                            <th class="pro-subtotal">Total</th>
                                            <th class="pro-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $key => $item)
                                            <tr>
                                                <td class="pro-thumbnail">
                                                    <a href="#">
                                                        <img class="img-fluid" src="{{ url('storage/', $item['hinh_anh']) }}" alt="Product" />
                                                        <input type="hidden" name="cart[{{ $key }}][hinh_anh]" value="{{ $item['hinh_anh'] }}">
                                                    </a>
                                                </td>
                                                <td class="pro-title">
                                                    <a href="{{ route('details', $key) }}">{{ $item['ten_san_pham'] }}</a>
                                                    <input type="hidden" name="cart[{{ $key }}][ten_san_pham]" value="{{ $item['ten_san_pham'] }}">
                                                </td>
                                                <td class="pro-price">
                                                    <span>{{ number_format($item['gia'], 0, '', '.') }} đ</span>
                                                    <input type="hidden" name="cart[{{ $key }}][gia]" value="{{ $item['gia'] }}">
                                                </td>
                                                <td class="pro-quantity">
                                                    <div class="input-group">
                                                        <button class="btn btn-outline-secondary" type="button" data-key="{{ $key }}">-</button>
                                                        <input type="number" class="form-control text-center" data-key="{{ $key }}" value="{{ $item['so_luong'] }}" name="cart[{{ $key }}][so_luong]" min="1" readonly>
                                                        <button class="btn btn-outline-secondary" type="button" data-key="{{ $key }}">+</button>
                                                    </div>
                                                </td>
                                                <td class="pro-subtotal">
                                                    <span class="subtotal">{{ number_format($item['gia'] * $item['so_luong'], 0, '', '.') }} đ</span>
                                                </td>
                                                <td class="pro-remove">
                                                    <button type="button" class="btn btn-danger btn-remove" data-id="{{ $key }}"><i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                @if (session('quantity'))
                                    <div class="alert alert-danger">{{ session('quantity') }}</div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <!-- Cart Update Option -->
                            <div class="cart-update-option d-block d-md-flex justify-content-end">
                                <div class="cart-update">
                                    <button type="submit" class="btn btn-sqr">Update Cart</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <!-- Cart Calculation Area -->
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h6>Cart Totals</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>Sub Total</td>
                                            <td class="sub-total">{{ number_format($subTotal, 0, '', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping</td>
                                            <td class="shipping">{{ number_format($shipping, 0, '', '.') }}</td>
                                        </tr>
                                        @if (session()->has('coupon'))
                                            <tr>
                                                <td>Discount ({{ session('coupon')['code'] }})</td>
                                                <td>-{{ number_format(session('coupon')['discount'], 0, '', '.') }} đ</td>
                                            </tr>
                                            <tr class="total">
                                                <td>Total</td>
                                                <td class="total-amount">{{ number_format(session('coupon')['discounted_total'], 0, '', '.') }} đ</td>
                                            </tr>
                                        @else
                                            <tr class="total">
                                                <td>Total</td>
                                                <td class="total-amount">{{ number_format($subTotal + $shipping, 0, '', '.') }} đ</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                            <a href="{{ route('donhangs.create') }}" class="btn btn-sqr d-block">Proceed Checkout</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <div class="discount-code-wrapper mt-3">
                            <form action="{{ route('coupons.apply') }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="code" class="form-control" placeholder="Enter your coupon code" required>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-sqr">Apply Coupon</button>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('coupons.remove') }}" method="GET" class="mt-2">
                                @csrf
                                <button type="submit" class="btn btn-sqr">Remove Coupon</button>
                            </form>
                            @if (session('error'))
                                <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart main wrapper end -->
</main>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cập nhật tổng tiền
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.pro-subtotal .subtotal').forEach(function(subtotalElement) {
                total += parseFloat(subtotalElement.textContent.replace(/\./g, '').replace(' đ', ''));
            });
            document.querySelector('.total-amount').textContent = `${total.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.')} đ`;
        }

        // Cập nhật subtotal khi số lượng thay đổi
        function updateSubtotal(input) {
            let row = input.closest('tr');
            let price = parseFloat(row.querySelector('.pro-price span').textContent.replace(/\./g, '').replace(' đ', ''));
            let quantity = parseInt(input.value);
            let subtotal = price * quantity;
            row.querySelector('.pro-subtotal .subtotal').textContent = `${subtotal.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.')} đ`;
            updateTotal();
        }

        // Xử lý sự kiện thay đổi số lượng
        document.querySelectorAll('.input-group button').forEach(function(button) {
            button.addEventListener('click', function() {
                let input = this.parentNode.querySelector('.form-control');
                let currentQuantity = parseInt(input.value);
                let newQuantity = this.textContent === '+' ? currentQuantity + 1 : currentQuantity - 1;
                if (newQuantity >= 1) {
                    input.value = newQuantity;
                    updateSubtotal(input);
                }
            });
        });

        // Xử lý sự kiện xóa sản phẩm
        document.querySelectorAll('.btn-remove').forEach(function(button) {
            button.addEventListener('click', function() {
                var row = this.closest('tr');
                row.remove();
                updateTotal();
            });
        });
    });
</script>
@endsection