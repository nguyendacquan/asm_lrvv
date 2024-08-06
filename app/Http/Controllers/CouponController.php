<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate(['code' => 'required']);

        // Kiểm tra mã giảm giá từ cơ sở dữ liệu
        $coupon = Coupon::where('code', $request->code)->first();

        if (!$coupon || !$coupon->isValid()) {
            return redirect()->back()->withErrors(['error' => 'Invalid or expired coupon code']);
        }

        // Lấy giỏ hàng từ phiên
        $cart = session()->get('cart', []);

        // Tính tổng số tiền từ giỏ hàng
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['gia'] * $item['so_luong'];
        }

        // Tính toán tổng sau khi giảm giá và đảm bảo không bị âm
        $discount = min($coupon->discount, $total);
        $discountedTotal = max($total - $discount, 0);

        // Kiểm tra xem đã có mã giảm giá trong phiên chưa
        if (session()->has('coupon')) {
            return redirect()->back()->withErrors(['error' => 'A coupon has already been applied']);
        }

        // Lưu mã giảm giá vào phiên
        session()->put('coupon', [
            'code' => $coupon->code,
            'discount' => $discount,
            'discounted_total' => $discountedTotal,
        ]);

        $user = Auth::user();

        // Lưu mã giảm giá đã sử dụng vào cơ sở dữ liệu
        $user->coupons()->attach($coupon->id);

        return redirect()->back()->with('success', 'Coupon applied successfully');
    }

    public function remove()
    {
        // Lấy mã giảm giá từ phiên
        $coupon = session()->get('coupon');

        if ($coupon) {
            $user = Auth::user();

            // Gỡ liên kết mã giảm giá khỏi người dùng
            $user->coupons()->detach(Coupon::where('code', $coupon['code'])->first()->id);

            // Xóa mã giảm giá khỏi phiên
            session()->forget('coupon');
        }

        return redirect()->back()->with('success', 'Coupon removed successfully');
    }
}
