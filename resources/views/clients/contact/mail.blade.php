<html>
<head>
    <title>Liên hệ từ website</title>
</head>
<body>
   
    <p style="font-size: 30px"><strong>Chủ đề:</strong> {{ $lienHe['chu_de'] }}</p>
    <p><strong>Tên:</strong> {{ $lienHe['ho_va_ten'] }}</p>
    <p><strong>Số điện thoại:</strong> {{ $lienHe['so_dien_thoai'] }}</p>
    <p><strong>Email:</strong> {{ $lienHe['email'] }}</p>
    <p><strong>Tin nhắn:</strong></p>
    <p>{{ $lienHe['message'] }}</p>
    <img src="{{ asset('storage/' . $images) }}" alt="Uploaded Image">

</body>
</html>