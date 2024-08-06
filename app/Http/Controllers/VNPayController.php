<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VNPayController extends Controller
{
    //
    public function createPayment($orderId, $amount, $orderInfo)
{
    // Xử lý và kiểm tra tham số
    if (!$orderId || !$amount || !$orderInfo) {
        return redirect()->back()->with('error', 'Tham số không hợp lệ.');
    }

    $vnp_TmnCode = env('VNP_TMN_CODE');
    $vnp_HashSecret = env('VNP_HASH_SECRET');
    $vnp_Url = 'https://www.vnpay.vn/vpcpay.html';
    $vnp_ReturnUrl = route('payment.return');

    $vnp_Amount = $amount * 100; // Chuyển đổi sang đơn vị nhỏ nhất (ví dụ: VND)

    $vnp_Params = array(
        'vnp_Version' => '2.1.0',
        'vnp_Command' => 'pay',
        'vnp_TmnCode' => $vnp_TmnCode,
        'vnp_Amount' => $vnp_Amount,
        'vnp_Locale' => 'vn',
        'vnp_BankCode' => 'VNBANK',
        'vnp_CreateDate' => date('YmdHis'),
        'vnp_CurrCode' => 'VND',
        'vnp_IpAddr' => request()->ip(),
        'vnp_OrderInfo' => $orderInfo,
        'vnp_OrderType' => 'billpayment',
        'vnp_ReturnUrl' => $vnp_ReturnUrl,
        'vnp_TxnRef' => $orderId,
    );

    ksort($vnp_Params);
    $query = urldecode(http_build_query($vnp_Params));
    $hashData = $query . '&' . $vnp_HashSecret; // Nối query và secret
    $vnp_SecureHash = hash('sha256', $hashData); // Tính toán hash bảo mật

    $vnp_Params['vnp_SecureHashType'] = 'SHA256';
    $vnp_Params['vnp_SecureHash'] = $vnp_SecureHash;

    $vnp_Url .= '?' . http_build_query($vnp_Params);

    // Ghi log URL để kiểm tra
    Log::info('URL Thanh toán VNPay:', ['url' => $vnp_Url]);

    return redirect($vnp_Url); // Chuyển hướng đến VNPay
}



    public function paymentReturn(Request $request)
    {
        $vnp_HashSecret = env('VNP_HASH_SECRET');

        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        $vnp_TxnRef = $request->input('vnp_TxnRef');
        $vnp_SecureHash = $request->input('vnp_SecureHash');
        $vnp_Params = $request->except('vnp_SecureHash');

        ksort($vnp_Params);
        $hashData = urldecode(http_build_query($vnp_Params)) . '&' . $vnp_HashSecret;
        $secureHash = strtoupper(hash('sha256', $hashData));

        if ($secureHash === $vnp_SecureHash) {
            if ($vnp_ResponseCode == '00') {
                return redirect()->route('donhangs.thank')->with('success', 'Thanh toán thành công.');
            } else {
                return redirect()->route('donhangs.thank')->with('error', 'Thanh toán thất bại.');
            }
        } else {
            return redirect()->route('donhangs.thank')->with('error', 'Lỗi xác thực.');
        }
    }
}
