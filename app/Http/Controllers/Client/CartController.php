<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;


class CartController extends Controller
{
    //


    public function listCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $total = 0;
        $subTotal = 0;
        foreach ($cart as $item) {
            $subTotal += $item['gia'] * $item['so_luong'];
        }
        $shipping = 3000;
        $total = $subTotal + $shipping;

        return view('clients.sanpham.cart', compact('cart', 'subTotal', 'shipping', 'total'));
    }

    public function addCart(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validated = $request->validate([
            'product_id' => 'required|exists:san_phams,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
    
        // Tìm sản phẩm trong cơ sở dữ liệu
        $sanPham = SanPham::query()->findOrFail($productId);
    
        // Kiểm tra số lượng sản phẩm còn lại
        if ($quantity > $sanPham->so_luong) {
            // Nếu số lượng yêu cầu vượt quá số lượng có sẵn, trả về thông báo lỗi
            return redirect()->back()->withErrors(['quantity' => 'Số lượng yêu cầu vượt quá số lượng có sẵn.']);
        }
    
        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);
    
        if (isset($cart[$productId])) {
            // Sản phẩm đã có trong giỏ hàng, cập nhật số lượng
            $newQuantity = $cart[$productId]['so_luong'] + $quantity;
    
            if ($newQuantity > $sanPham->so_luong) {
                // Nếu tổng số lượng vượt quá số lượng có sẵn, điều chỉnh số lượng
                $cart[$productId]['so_luong'] = $sanPham->so_luong;
                return redirect()->back()->withErrors(['quantity' => "Số lượng trong giỏ hàng của bạn đã thêm vượt quá sản phẩm còn lại!"]);
            } else {
                // Cập nhật số lượng trong giỏ hàng
                $cart[$productId]['so_luong'] = $newQuantity;
            }
        } else {
            // Sản phẩm chưa có trong giỏ hàng, thêm mới
            $cart[$productId] = [
                'ten_san_pham' => $sanPham->ten_san_pham,
                'so_luong' => $quantity,
                'gia' => $sanPham->gia_khuyen_mai ?? $sanPham->gia_san_pham,
                'hinh_anh' => $sanPham->hinh_anh,
            ];
        }
    
        // Cập nhật giỏ hàng trong session
        session()->put('cart', $cart);
    
        // Redirect về trang trước đó
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

   public function updateCart(Request $request)
{
    // Xác thực dữ liệu đầu vào
    $validated = $request->validate([
        'cart.*.so_luong' => 'required|integer|min:1',
        'cart.*.hinh_anh' => 'required|string',
        'cart.*.ten_san_pham' => 'required|string',
        'cart.*.gia' => 'required|numeric',
    ]);

    // Lấy dữ liệu giỏ hàng từ request
    $cartNew = $request->input('cart', []);
    $updatedCart = [];
    $errors = [];

    foreach ($cartNew as $key => $item) {
        $productId = $key;
        $requestedQuantity = $item['so_luong'];

        // Tìm sản phẩm trong cơ sở dữ liệu
        $sanPham = SanPham::query()->find($productId);

        if (!$sanPham) {
            // Nếu sản phẩm không tồn tại, bỏ qua
            continue;
        }

        // Kiểm tra số lượng có sẵn
        if ($requestedQuantity > $sanPham->so_luong) {
            // Nếu số lượng yêu cầu vượt quá số lượng có sẵn, điều chỉnh số lượng và lưu lỗi
            $requestedQuantity = $sanPham->so_luong;
            $errors[$productId] = 'Số lượng yêu cầu đã được điều chỉnh để không vượt quá số lượng có sẵn.';
        }

        $updatedCart[$productId] = [
            'ten_san_pham' => $item['ten_san_pham'],
            'so_luong' => $requestedQuantity,
            'gia' => $item['gia'],
            'hinh_anh' => $item['hinh_anh'],
        ];
    }

    // Cập nhật giỏ hàng trong session
    session()->put('cart', $updatedCart);

    // Thông báo cho người dùng
    if ($errors) {
        return redirect()->back()->withErrors($errors)->with('quantity', 'Vượt quá số lượng có sẵn !');
    }

    return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật.');
}

    public function clearCart()
    {
        // Remove the cart from the ses
        session()->forget('cart');

        // Redirect back to the previous page or to the cart page
        return redirect()->back();
    }
}
