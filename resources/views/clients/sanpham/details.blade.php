@extends('layouts.client')


@section('content')
    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">
            <div class="row">
                <!-- product details wrapper start -->
                <div class="col-lg-12 order-1 order-lg-2">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider">
                                    <div class="pro-large-img img-zoom">
                                        <img style="border-radius:4px" src="{{ url('storage/', $sanPham->hinh_anh) }}"
                                            alt="product-details" />
                                    </div>
                                    @foreach ($sanPham->hinhAnhsanPham as $item)
                                        <div class="pro-large-img img-zoom">
                                            <img style="border-radius:4px" src="{{ url('storage/', $item->hinh_anh) }}"
                                                alt="product-details" />
                                        </div>
                                    @endforeach

                                </div>
                                <div class="pro-nav slick-row-10 slick-arrow-style">
                                    <div class="pro-nav-thumb">
                                        <img style="border-radius:4px" src="{{ url('storage/', $sanPham->hinh_anh) }}"
                                            alt="product-details" />
                                    </div>

                                    @foreach ($sanPham->hinhAnhsanPham as $item)
                                        <div class="pro-nav-thumb">
                                            <img style="border-radius:4px" src="{{ url('storage/', $item->hinh_anh) }}"
                                                alt="product-details" />
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <div class="manufacturer-name">
                                        <a href="product-details.html">HasTech</a>
                                    </div>
                                    <h3 class="product-name">{{ $sanPham->ten_san_pham }}</h3>
                                    <div class="ratings d-flex">
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <div class="pro-review">
                                            <span>1 Reviews</span>
                                        </div>
                                    </div>
                                    <div class="price-box">
                                        <span class="price-regular">{{ number_format($sanPham->gia_khuyen_mai) }} đ</span>
                                        <span class="price-old"><del>{{ number_format($sanPham->gia_san_pham) }}
                                                đ</del></span>
                                    </div>
                                    {{-- <h5 class="offer-text"><strong>Hurry up</strong>! offer ends in:</h5>
                                    <div class="product-countdown" data-countdown="2022/12/20"></div> --}}
                                    <div class="availability">
                                        <i class="fa fa-check-circle"></i>
                                        <span
                                            id="availableQuantity">{{ $sanPham->so_luong === 0 ? 'Hết hàng' : "Số lượng: $sanPham->so_luong" }}</span>
                                    </div>
                                    <p class="pro-desc">{{ $sanPham->mo_ta_ngan }}</p>
                                    @if ($sanPham->so_luong === 0)
                                        <div class="action_link mb-3">
                                            <button type="submit" disabled class="btn btn-cart2">Add to cart</button>
                                        </div>
                                        </form>
                                    @else
                                        <form action="{{ route('cart.add') }}" method="POST" id="cartForm">
                                            @csrf
                                            <div class="quantity-cart-box d-flex align-items-center">
                                                <h6 class="option-title">qty:</h6>
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input type="text" name="quantity" value="1"
                                                            id="quantityInput">
                                                    </div>
                                                    <input type="hidden" name="product_id" value="{{ $sanPham->id }}">
                                                </div>
                                                <div class="action_link">
                                                    <button type="submit" class="btn btn-cart2">Add to cart</button>
                                                </div>
                                            </div>
                                        </form>
                                    @endif

                                    {{-- color size --}}

                                    <div class="like-icon">
                                        <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                        <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                        <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                        <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                    </div>
                                    <div class="mt-3">
                                        @if (session('success'))
                                            <div class="alert alert-success">{{ session('success') }}</div>
                                        @endif
                                        @if (session('quantity'))
                                            <div class="text-danger">{{ session('quantity') }}</div>
                                        @endif

                                        @error('quantity')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- product details inner end -->

                    <!-- product details reviews start -->
                    <div class="product-details-reviews section-padding pb-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <ul class="nav review-tab">
                                        <li>
                                            <a class="active" data-bs-toggle="tab" href="#tab_one">description</a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tab" href="#tab_two">information</a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tab" href="#tab_three">reviews (1)</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content reviews-tab">
                                        <div class="tab-pane fade show active" id="tab_one">
                                            <div class="tab-one">
                                                <p>{!! $sanPham->noi_dung !!}</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_two">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td>color</td>
                                                        <td>black, blue, red</td>
                                                    </tr>
                                                    <tr>
                                                        <td>size</td>
                                                        <td>L, M, S</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="tab_three">
                                            <form action="{{ route('binhluan') }}" method="POST" class="review-form">
                                                @csrf
                                                <input type="hidden" name="san_pham_id" value="{{ $sanPham->id }}">
                                                <h5>Đánh giá sản phẩm: <span>{{ $sanPham->ten }}</span></h5>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span> Bình luận của bạn</label>
                                                        <textarea class="form-control" name="noi_dung" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span> Đánh giá</label>
                                                        &nbsp;&nbsp;&nbsp; Xấu&nbsp;
                                                        <input type="radio" value="1" name="danh_gia" required>
                                                        &nbsp;
                                                        <input type="radio" value="2" name="danh_gia">
                                                        &nbsp;
                                                        <input type="radio" value="3" name="danh_gia">
                                                        &nbsp;
                                                        <input type="radio" value="4" name="danh_gia">
                                                        &nbsp;
                                                        <input type="radio" value="5" name="danh_gia" checked>
                                                        &nbsp;Tốt
                                                    </div>
                                                </div>
                                                <div class="buttons">
                                                    <button class="btn btn-sqr" type="submit">Gửi</button>
                                                </div>
                                            </form>                                            
                                    
                                            <div class="comments">
                                                <!-- Place to display comments -->
                                                @foreach($sanPham->binhLuans as $binhLuan)
                                                    <div class="comment">
                                                        <div class="rev-avatar">
                                                            <img src="{{ asset('storage/' . $binhLuan->nguoiDung->hinh_anh) }}" alt="" width=" 60px">
                                                        </div>
                                                        <div class="review-box">
                                                            <div class="ratings">
                                                                @for ($i = 0; $i < $binhLuan->danh_gia; $i++)
                                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                                @endfor
                                                                @for ($i = $binhLuan->danh_gia; $i < 5; $i++)
                                                                    <span><i class="fa fa-star"></i></span>
                                                                @endfor
                                                            </div>
                                                            <div class="post-author">
                                                                <p><span>{{ $binhLuan->nguoiDung->name }} -</span> {{ $binhLuan->created_at->format('d M, Y') }}</p>
                                                            </div>
                                                            <p>{{ $binhLuan->noi_dung }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details reviews end -->
                </div>
                <!-- product details wrapper end -->
            </div>
        </div>
    </div>

    <section class="related-products section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Related Products</h2>
                        <p class="sub-title">Add related products to weekly lineup</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                        <!-- product item start -->
                        @foreach ($listSanPham as $item)
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="product-details.html">
                                        <img class="pri-img" src="{{ url('storage/', $item->hinh_anh) }}"
                                            alt="product">
                                        <img class="sec-img" src="{{ url('storage/', $item->hinh_anh) }}"
                                            alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>new</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>10%</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                            title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                            title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span
                                                data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i
                                                    class="pe-7s-search"></i></span></a>
                                    </div>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                        <div class="cart-hover">
                                            <button class="btn btn-cart">add to cart</button>
                                        </div>
                                    </form>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a
                                                href="product-details.html">{{ $sanPham->danhMuc->ten_danh_muc }}</a></p>
                                    </div>
                                    <ul class="color-categories">
                                        <li>
                                            <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                        </li>
                                        <li>
                                            <a class="c-darktan" href="#" title="Darktan"></a>
                                        </li>
                                        <li>
                                            <a class="c-grey" href="#" title="Grey"></a>
                                        </li>
                                        <li>
                                            <a class="c-brown" href="#" title="Brown"></a>
                                        </li>
                                    </ul>
                                    <h6 class="product-name">
                                        <a href="product-details.html">{{ $sanPham->ten_san_pham }}</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">{{ number_format($sanPham->gia_khuyen_mai) }} đ</span>
                                        <span class="price-old"><del>{{ number_format($sanPham->gia_san_pham) }}
                                                đ</del></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- product item end -->


                        <!-- product item end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        // quantity change js
        $('.pro-qty').prepend('<span class="dec qtybtn">-</span>');
        $('.pro-qty').append('<span class="inc qtybtn">+</span>');
        $('.qtybtn').on('click', function() {
            var $button = $(this);
            var $input = $button.parent().find('input')
            var oldValue = parseFloat($input.val());
            if ($button.hasClass('inc')) {
                var newVal = oldValue + 1;
            } else {
                if (oldValue > 1) {
                    var newVal = oldValue - 1;
                } else {
                    var newVal = 1;
                }
            }
            $input.val(newVal);

        });

        // xu ly new nguoi dung nhap so AM
        $('#quantityInput').on('change', function() {
            var value = parseInt($(this).val(), 10);
            if (isNaN(value) || value < 1) {
                alert('Số lượng phải lớn hơn hoặc bằng 1');
                $(this).val(1);
            }
        })
    </script>
    {{-- // check so luong --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('cartForm');
            const quantityInput = document.getElementById('quantityInput');
            const availableQuantityElement = document.getElementById('availableQuantity');
            const availableQuantity = parseInt(availableQuantityElement.textContent);

            form.addEventListener('submit', function(event) {
                const requestedQuantity = parseInt(quantityInput.value);

                if (requestedQuantity > availableQuantity) {
                    event.preventDefault(); // Ngăn chặn gửi form
                    alert('Số lượng yêu cầu vượt quá số lượng có sẵn.');
                }
            });
        });
    </script>
@endsection
