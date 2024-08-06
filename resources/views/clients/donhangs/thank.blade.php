@extends('layouts.client')

@section('content')

<style>
.thanks-container {
    display: inline-block;
    position: relative;
}

.thanks-text {
    font-size: 4rem; /* Kích thước chữ lớn */
    font-weight: bold; /* Đậm chữ */
    color: #fff; /* Màu chữ chính */
    background: linear-gradient(135deg, #ff6f61, #d45d79); /* Nền gradient cho chữ */
    -webkit-background-clip: text; /* Cắt nền gradient theo chữ */
    background-clip: text; /* Cắt nền gradient theo chữ */
    text-fill-color: transparent; /* Ẩn màu chữ gốc để chỉ hiển thị gradient */
    text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.3); /* Hiệu ứng bóng chữ */
    transform: perspective(600px) rotateX(10deg); /* Tạo hiệu ứng 3D */
    display: inline-block;
}

.thanks-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #ff9a9e, #fad0c4); /* Nền gradient cho container */
    z-index: -1; /* Đặt nền nằm dưới chữ */
    transform: scale(1.05); /* Mở rộng nền để tạo cảm giác sâu */
    border-radius: 10px; /* Bo góc nền */
}


</style>
    <main>

        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('client.index')}}"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Thank !</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-account-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="thanks-container">
                                <div class="thanks-text">Cảm ơn quý khách đã đặt hàng</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </main>
@endsection
