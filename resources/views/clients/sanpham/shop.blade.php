@extends('layouts.client')



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
                                    <li class="breadcrumb-item active" aria-current="page">shop</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- page main wrapper start -->
        <div class="shop-main-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <!-- sidebar area start -->
                    <div class="col-lg-3 order-2 order-lg-1">
                        <aside class="sidebar-wrapper">
                            <!-- single sidebar start -->
                            <div class="sidebar-single">
                                <h5 class="sidebar-title">categories</h5>
                                <div class="sidebar-body">
                                    <ul class="shop-categories">
                                        <li><a href="/shop">All Products</a></li>
                                        @foreach ($listDanhMuc as $danhMucs)
                                            {{-- <li><a href="{{ route('client.shop', ['danh_muc_id' => $danhMucs->id]) }}">{{ $danhMucs->ten_danh_muc }} </a></li> --}}
                                            <li><a href="/shop?danh_muc_id={{ $danhMucs->id }}">{{ $danhMucs->ten_danh_muc }}
                                                </a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- single sidebar end -->

                            <!-- single sidebar end -->

                            <!-- single sidebar start -->

                            <!-- single sidebar end -->

                            <!-- single sidebar start -->

                            <!-- single sidebar end -->
                        </aside>
                    </div>
                    <!-- sidebar area end -->

                    <!-- shop main wrapper start -->
                    <div class="col-lg-9 order-1 order-lg-2">
                        <div class="shop-product-wrapper">
                            <!-- shop product top wrap start -->
                            <div class="shop-top-bar">
                                <div class="row align-items-center">
                                    <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                        <div class="top-bar-left">
                                            <div class="product-view-mode">
                                                <a class="active" href="#" data-target="grid-view"
                                                    data-bs-toggle="tooltip" title="Grid View"><i class="fa fa-th"></i></a>
                                                <a href="#" data-target="list-view" data-bs-toggle="tooltip"
                                                    title="List View"><i class="fa fa-list"></i></a>
                                            </div>
                                            <div class="product-amount">
                                                <p>Showing {{ $listSanPham->firstItem() }}–{{ $listSanPham->lastItem() }} of
                                                    {{ $totalProducts }} results</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                        <div class="top-bar-right">
                                            <div class="product-short">
                                                <p>Sort By : </p>
                                                <select class="nice-select" name="sortby">
                                                    <option value="trending">Relevance</option>
                                                    <option value="name-asc">Name (A - Z)</option>
                                                    <option value="name-desc">Name (Z - A)</option>
                                                    <option value="price-asc">Price (Low &gt; High)</option>
                                                    <option value="price-desc">Price (High &gt; Low)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- shop product top wrap start -->

                            <!-- product item list wrapper start -->
                            <div class="shop-product-wrap grid-view row mbn-30">


                                @foreach ($listSanPham as $item)
                                    <div class="col-md-4 col-sm-6">
                                        <!-- product grid start -->
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="{{ route('client.show', $item->id) }}">
                                                    <img class="sec-img" src="{{ url('storage/', $item->hinh_anh) }}"
                                                        alt="product">
                                                    <img class="pri-img" src="{{ url('storage/', $item->hinh_anh) }}"
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
                                                    <a href="wishlist.html" data-bs-toggle="tooltip"
                                                        data-bs-placement="left" title="Add to wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#quick_view"><span data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title="Quick View"><i
                                                                class="pe-7s-search"></i></span></a>
                                                </div>
                                                <div class="cart-hover">
                                                    <button class="btn btn-cart">add to cart</button>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                <div class="product-identity">
                                                    {{-- <p class="manufacturer-name"><a href="product-details.html">Platinum</a></p> --}}
                                                </div>
                                                {{-- <ul class="color-categories">
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
                                        </ul> --}}
                                                <h6 class="product-name">
                                                    <a href="product-details.html">{{ $item->ten_san_pham }}</a>
                                                </h6>
                                                <div class="price-box">
                                                    <span class="price-regular">{{ number_format($item->gia_khuyen_mai) }}
                                                        đ</span>
                                                    <span class="price-old"><del>{{ number_format($item->gia_san_pham) }}
                                                            đ</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product grid end -->

                                        <!-- product list item end -->
                                        <div class="product-list-item">
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
                                                    <a href="wishlist.html" data-bs-toggle="tooltip"
                                                        data-bs-placement="left" title="Add to wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="compare.html" data-bs-toggle="tooltip"
                                                        data-bs-placement="left" title="Add to Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#quick_view"><span data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title="Quick View"><i
                                                                class="pe-7s-search"></i></span></a>
                                                </div>
                                                <div class="cart-hover">
                                                    <button class="btn btn-cart">add to cart</button>
                                                </div>
                                            </figure>
                                            <div class="product-content-list">
                                                <div class="manufacturer-name">
                                                    <a href="product-details.html">Platinum</a>
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

                                                <h5 class="product-name"><a
                                                        href="product-details.html">{{ $item->ten_san_pham }}</a></h5>
                                                <div class="price-box">
                                                    <span class="price-regular">{{ number_format($item->gia_khuyen_mai) }}
                                                        đ</span>
                                                    <span class="price-old"><del>{{ number_format($item->gia_san_pham) }}
                                                            đ</del></span>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde
                                                    perspiciatis
                                                    quod numquam, sit fugiat, deserunt ipsa mollitia sunt quam corporis
                                                    ullam
                                                    rem, accusantium adipisci officia eaque.</p>
                                            </div>
                                        </div>
                                        <!-- product list item end -->
                                    </div>
                                @endforeach



                            </div>
                            <!-- product item list wrapper end -->

                            <!-- start pagination area -->
                            {{-- <div class="paginatoin-area text-center">
                            <ul class="pagination-box">
                                
                            </ul>
                        </div> --}}
                            <!-- end pagination area -->
                        </div>
                    </div>
                    <!-- shop main wrapper end -->
                </div>
            </div>
        </div>
        <!-- page main wrapper end -->
    </main>
@endsection
@section('js')
    <script>
        document.getElementById('sortby').addEventListener('change', function() {
            const sortby = this.value;
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('sortby', sortby);
            window.location.search = urlParams.toString();
        });
    </script>
@endsection
