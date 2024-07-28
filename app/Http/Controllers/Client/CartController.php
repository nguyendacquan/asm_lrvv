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
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $sanPham = SanPham::query()->findOrFail($productId);

        // tao 1 mang chua thong tin sesssion gio hang
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            // san pham co trong gio hang

            $cart[$productId]['so_luong'] += $quantity;
        } else {
            $cart[$productId] = [
                'ten_san_pham' => $sanPham->ten_san_pham,
                'so_luong' => $quantity,
                'gia' => $sanPham->gia_khuyen_mai ?? $sanPham->gia_san_pham,
                'hinh_anh' => $sanPham->hinh_anh,

            ];
            // san pham chua co trong gio hang
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function updateCart(Request $request)
    {
        $cartNew = $request->input('cart', []);
        session()->put('cart', $cartNew);
        return redirect()->back();
    }
    public function clearCart()
    {
        // Remove the cart from the session
        session()->forget('cart');

        // Redirect back to the previous page or to the cart page
        return redirect()->back();
    }
}
