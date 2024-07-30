@component('mail::message')
    # Xác nhận đơn hàng

    Xin chào {{$donHang->ten_nguoi_nhan}},

    Cảm ơn bạn đã đặt hàng từ cửa hangf của chúng tôi đây là thông tin đơn hàng của bạn:

    - Mã đơn Hàng: {{$donHang->ma_don_hang}}
    - Sản phẩm đã đặt:
    @foreach ($donHang->chiTietDonHang as $chiTiet)
            {{$chiTiet->sanPham->ten_san_pham}} X {{$chiTiet->so_luong}} : {{number_format($chiTiet->thanh_tien)}} VNĐ
    @endforeach
    - Tổng tiền: {{number_format($donHang->tong_tien)}} VNĐ


    Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận thồn tin giao hàng và cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi! 

    Trân trọng.
@endcomponent