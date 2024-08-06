<?php

namespace App\Http\Controllers\Client;

use App\Models\DonHang;
use App\Models\SanPham;
use App\Mail\OrderConfirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    //     public function index()
    //     {
    //         $donHang = Auth::user()->donHang;
    //         $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
    //         $type_cho_xac_nhan = DonHang::CHO_XAC_NHAN;
    //         $type_dang_van_chuyen = DonHang::DANG_VAN_CHUYEN;

    //         return view("clients.donhangs.index", compact('donHang', 'trangThaiDonHang', 'type_cho_xac_nhan', 'type_dang_van_chuyen'));
    //     }

    //     public function create()
    //     {
    //         $carts = session()->get('cart', []);
    //         if (!empty($carts)) {
    //             $subTotal = 0;
    //             foreach ($carts as $item) {
    //                 $subTotal += $item['gia'] * $item['so_luong'];
    //             }
    //             $shipping = 3000;
    //             $discount = session('coupon')['discount'] ?? 0;
    //             $total = $subTotal + $shipping - $discount;
    //             $orderId = uniqid(); // Tạo orderId tại đây

    //             return view("clients.donhangs.create", compact('carts', 'total', 'subTotal', 'shipping', 'orderId', 'discount'));
    //         }
    //         return redirect()->route('cart.list');
    //     }
    //     public function store(OrderRequest $request)
    //     {
    //         if ($request->isMethod('POST')) {
    //             DB::beginTransaction();
    //             try {
    //                 $parsams = $request->except('_token');
    //                 $parsams['ma_don_hang'] = $this->generateOrderCode();
    //                 $parsams['user_id'] = Auth::id();

    //                 $donHang = DonHang::query()->create($parsams);
    //                 $donHangId = $donHang->id;

    //                 $carts = session()->get('cart', []);

    //                 foreach ($carts as $key => $item) {
    //                     $thanhTien = $item['gia'] * $item['so_luong'];

    //                     $donHang->chiTietDonHang()->create([
    //                         'don_hang_id' => $donHangId,
    //                         'san_pham_id' => $key,
    //                         'don_gia' => $item['gia'],
    //                         'so_luong' => $item['so_luong'],
    //                         'thanh_tien' => $thanhTien,
    //                     ]);

    //                     $sanPham = SanPham::find($key);
    //                     if ($sanPham) {
    //                         $sanPham->so_luong -= $item['so_luong'];
    //                         if ($sanPham->so_luong < 0) {
    //                             throw new \Exception("Số lượng sản phẩm không đủ để hoàn tất đơn hàng.");
    //                         }
    //                         $sanPham->save();
    //                     }
    //                 }

    //                 DB::commit();
    //                 Mail::to($donHang->email_nguoi_nhan)->queue(new OrderConfirm($donHang));

    //                 session()->put('cart', []);
    //                 return redirect()->route('donhangs.thank')->with('success', 'Đơn hàng đã được tạo thành công');
    //             } catch (\Exception $e) {
    //                 DB::rollBack();
    //                 return redirect()->route('cart.list')->with('error', 'Có lỗi khi tạo đơn hàng. Vui lòng thử lại.');
    //             }
    //         }
    //     }

    //     public function show(string $id)
    //     {
    //         $donHang = DonHang::query()->findOrFail($id);
    //         $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
    //         $trangThaiThanhToan = DonHang::TRANG_THAI_THANH_TOAN;
    //         return view('clients.donhangs.show', compact('donHang', 'trangThaiDonHang', 'trangThaiThanhToan'));
    //     }

    //     public function update(Request $request, string $id)
    //     {
    //         $donHang = DonHang::query()->findOrFail($id);
    //         try {
    //             if ($request->has('huy_don_hang')) {
    //                 $donHang->update(['trang_thai_don_hang' => DonHang::HUY_DON_HANG]);
    //             } elseif ($request->has('da_giao_hang')) {
    //                 $donHang->update(['trang_thai_don_hang' => DonHang::DA_GIAO_HANG]);
    //             }
    //             DB::commit();
    //         } catch (\Exception $e) {
    //             DB::rollBack();
    //         }
    //         return redirect()->back();
    //     }

    //     public function destroy(string $id)
    //     {
    //     }

    //     public function thanks()
    //     {
    //         return view('clients.donhangs.thank');
    //     }

    //     private function generateOrderCode()
    //     {
    //         $unique = false;
    //         while (!$unique) {
    //             $orderCode = 'ORD-' . Auth::id() . '-' . bin2hex(random_bytes(4));
    //             $unique = !DonHang::where('ma_don_hang', $orderCode)->exists();
    //         }
    //         return $orderCode;
    //     }
    // }
    public function index()
    {
        //
        $donHang = Auth::user()->donHang;
        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
        $type_cho_xac_nhan = DonHang::CHO_XAC_NHAN;
        $type_dang_van_chuyen = DonHang::DANG_VAN_CHUYEN;

        return view("clients.donhangs.index", compact('donHang', 'trangThaiDonHang', 'type_cho_xac_nhan', 'type_dang_van_chuyen'));
    }


    public function create()
    {
        $carts = session()->get('cart', []);
        $discount = session('coupon')['discount'] ?? 0; // Lấy mã giảm giá từ session

        if (!empty($carts)) {
            $subTotal = 0;
            foreach ($carts as $item) {
                $subTotal += $item['gia'] * $item['so_luong'];
            }
            $shipping = 3000;
            $total = $subTotal + $shipping - $discount; // Áp dụng mã giảm giá

            return view('clients.donhangs.create', compact('carts', 'total', 'subTotal', 'shipping', 'discount'));
        }
        return redirect()->route('cart.list');
    }

    // giam gia


    public function store(OrderRequest $request)
    {
        DB::beginTransaction();
        try {
            $parsams = $request->except('_token');
            $parsams['ma_don_hang'] = $this->generateOrderCode();
            $parsams['discount'] = $request->input('discount', 0); // Lưu mã giảm giá

            $donHang = DonHang::query()->create($parsams);
            $donHangId = $donHang->id;

            $carts = session()->get('cart', []);

            foreach ($carts as $key => $item) {
                $thanhTien = $item['gia'] * $item['so_luong'];

                $donHang->chiTietDonHang()->create([
                    'don_hang_id' => $donHangId,
                    'san_pham_id' => $key,
                    'don_gia' => $item['gia'],
                    'so_luong' => $item['so_luong'],
                    'thanh_tien' => $thanhTien,
                ]);

                $sanPham = SanPham::find($key);
                if ($sanPham) {
                    $sanPham->so_luong -= $item['so_luong'];
                    if ($sanPham->so_luong < 0) {
                        throw new \Exception("Số lượng sản phẩm không đủ để hoàn tất đơn hàng.");
                    }
                    $sanPham->save();
                }
            }

            DB::commit();
            Mail::to($donHang->email_nguoi_nhan)->queue(new OrderConfirm($donHang));
            session()->put('cart', []);
            return redirect()->route('donhangs.thank')->with('success', 'Đơn hàng đã được tạo thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.list')->with('error', 'Có lỗi khi tạo đơn hàng. Vui lòng thử lại.');
        }
    }

    public function show(string $id)
    {
        //
        $donHang = DonHang::query()->findOrFail($id);
        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
        $trangThaiThanhToan = DonHang::TRANG_THAI_THANH_TOAN;
        return view('clients.donhangs.show', compact('donHang', 'trangThaiDonHang', 'trangThaiThanhToan'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
        $donHang = DonHang::query()->findOrFail($id);
        try {
            if ($request->has('huy_don_hang')) {
                $donHang->update(['trang_thai_don_hang' => DonHang::HUY_DON_HANG]);
            } elseif ($request->has('da_giao_hang')) {
                $donHang->update(['trang_thai_don_hang' => DonHang::DA_GIAO_HANG]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return redirect()->back();
    }

    public function destroy(string $id)
    {
    }


    public function thanks()
    {
        return view('clients.donhangs.thank');
    }

    function generateOrderCode()
    {
        do {
            $orderCode = 'ORD-' . Auth::id() . '-' . now()->timestamp;
        } while (DonHang::where('ma_don_hang', $orderCode)->exists());
        return $orderCode;
    }
}
