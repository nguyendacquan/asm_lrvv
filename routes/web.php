<?php

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QRPaymentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\DonHangController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\BaiVietController as AdminBaiVietController;
use App\Http\Controllers\Admin\BinhLuanController as AdminBinhLuanController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;
use App\Http\Controllers\Client\BinhLuanController;
use App\Http\Controllers\Client\UserController as ClientUserController;
use App\Http\Controllers\Client\BogController;
use App\Http\Controllers\Client\VNPayController as ClientVNPayController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\VNPayController;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['ip.whitelist'])->group(function () {
    // Thêm các tuyến đường cần bảo vệ bởi IP whitelist vào đây

    // Route::get('login', [AuthController::class, 'showFormlogin']);
    // Route::post('login', [AuthController::class, 'login'])->name('login');
    // Route::get('register', [AuthController::class, 'showFormRegister']);
    // Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('logoutt', [AuthController::class, 'logoutt'])->name('logoutt');



    Route::middleware('auth')->prefix('donhangs')

        ->as('donhangs.')
        ->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/create', [OrderController::class, 'create'])->name('create');
            Route::post('/store', [OrderController::class, 'store'])->name('store');
            Route::get('/show/{id}', [OrderController::class, 'show'])->name('show');
            Route::put('{id}/update', [OrderController::class, 'update'])->name('update');
            Route::get('/thank', [OrderController::class, 'thanks'])->name('thank');
        });



    Route::middleware(['auth', 'auth.admin'])->prefix('admins')
        ->as('admins.')
        ->group(function () {
            Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
            Route::prefix('danhmucs')
                ->as('danhmucs.')
                ->group(function () {
                    Route::get('/', [DanhMucController::class, 'index'])->name('index');
                    Route::get('/create', [DanhMucController::class, 'create'])->name('create');
                    Route::post('/store', [DanhMucController::class, 'store'])->name('store');
                    Route::get('/show/{id}', [DanhMucController::class, 'show'])->name('show');
                    Route::get('{id}/edit', [DanhMucController::class, 'edit'])->name('edit');
                    Route::put('{id}/update', [DanhMucController::class, 'update'])->name('update');
                    Route::delete('{id}/destroy', [DanhMucController::class, 'destroy'])->name('destroy');
                });
            Route::prefix('sanphams')
                ->as('sanphams.')
                ->group(function () {
                    Route::get('/', [SanPhamController::class, 'index'])->name('index');
                    Route::get('/create', [SanPhamController::class, 'create'])->name('create');
                    Route::post('/store', [SanPhamController::class, 'store'])->name('store');
                    Route::get('/show/{id}', [SanPhamController::class, 'show'])->name('show');
                    Route::get('{id}/edit', [SanPhamController::class, 'edit'])->name('edit');
                    Route::put('{id}/update', [SanPhamController::class, 'update'])->name('update');
                    Route::delete('{id}/destroy', [SanPhamController::class, 'destroy'])->name('destroy');
                    Route::get('sanphams/{san_pham_id}/binhluans', [AdminBinhLuanController::class, 'index'])->name('binhluans');
                    Route::delete('binhluans/{id}', [AdminBinhLuanController::class, 'destroy'])->name('binhluansDestroy');
                });

            Route::prefix('baiviet')
                ->as('baiviet.')
                ->group(function () {
                    Route::get('/', [AdminBaiVietController::class, 'index'])->name('index');
                    Route::get('/create', [AdminBaiVietController::class, 'create'])->name('create');
                    Route::post('/store', [AdminBaiVietController::class, 'store'])->name('store');
                    Route::get('/show/{id}', [AdminBaiVietController::class, 'show'])->name('show');
                    Route::get('{id}/edit', [AdminBaiVietController::class, 'edit'])->name('edit');
                    Route::put('{id}/update', [AdminBaiVietController::class, 'update'])->name('update');
                    Route::delete('{id}/destroy', [AdminBaiVietController::class, 'destroy'])->name('destroy');
                });


            Route::prefix('users')
                ->as('users.')
                ->group(function () {
                    Route::get('/', [AdminUserController::class, 'index'])->name('index');
                    Route::get('/create', [AdminUserController::class, 'create'])->name('create');
                    Route::post('/store', [AdminUserController::class, 'store'])->name('store');
                    Route::get('/show/{id}', [AdminUserController::class, 'show'])->name('show');
                    Route::get('{id}/edit', [AdminUserController::class, 'edit'])->name('edit');
                    Route::put('{id}/update', [AdminUserController::class, 'update'])->name('update');
                    Route::delete('{id}/destroy', [AdminUserController::class, 'destroy'])->name('destroy');
                });
            Route::prefix('donhangs')
                ->as('donhangs.')
                ->group(function () {
                    Route::get('/', [DonHangController::class, 'index'])->name('index');
                    Route::get('/show/{id}', [DonHangController::class, 'show'])->name('show');
                    Route::put('{id}/update', [DonHangController::class, 'update'])->name('update');
                    Route::delete('{id}/destroy', [DonHangController::class, 'destroy'])->name('destroy');
                    Route::get('donhangs/deleted', [DonHangController::class, 'deleted'])->name('deleted');
                    Route::post('donhangs/{id}/restore', [DonHangController::class, 'restore'])->name('restore');
                    Route::delete('donhangs/{id}/force-delete', [DonHangController::class, 'forceDelete'])->name('force-delete');
                });
            Route::prefix('slider')
                ->as('slider.')
                ->group(function () {
                    Route::get('/', [BannerController::class, 'index'])->name('index');
                    Route::get('/create', [BannerController::class, 'create'])->name('create');
                    Route::post('/store', [BannerController::class, 'store'])->name('store');
                    Route::get('/show/{id}', [BannerController::class, 'show'])->name('show');
                    Route::get('{id}/edit', [BannerController::class, 'edit'])->name('edit');
                    Route::put('{id}/update', [BannerController::class, 'update'])->name('update');
                    Route::delete('{id}/destroy', [BannerController::class, 'destroy'])->name('destroy');
                });
            Route::prefix('coupons')
                ->as('coupons.')
                ->group(function () {
                    Route::get('/', [AdminCouponController::class, 'index'])->name('index');
                    Route::get('/create', [AdminCouponController::class, 'create'])->name('create');
                    Route::post('/store', [AdminCouponController::class, 'store'])->name('store');
                    Route::get('/show/{id}', [AdminCouponController::class, 'show'])->name('show');
                    Route::get('/{coupon}/edit', [AdminCouponController::class, 'edit'])->name('edit');
                    Route::put('/{coupon}', [AdminCouponController::class, 'update'])->name('update');
                    Route::delete('/{coupon}', [AdminCouponController::class, 'destroy'])->name('destroy');;
                });
        });
});
Route::get('details{id}', [ClientController::class, 'details'])->name('details');
Route::get('/list-cart', [CartController::class, 'listCart'])->name('cart.list');
Route::post('/add-to-cart', [CartController::class, 'addCart'])->name('cart.add');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/clearCart', [CartController::class, 'clearCart'])->name('clearCart');
Route::get('/shop', [ClientController::class, 'shop'])->name('shop');
Route::get('/myaccount', [ClientController::class, 'myaccount'])->name('myaccount');
Route::get('/myEdit{id}', [ClientController::class, 'myEdit'])->name('myEdit');
Route::put('/myUpdate{id}', [ClientController::class, 'myUpdate'])->name('myUpdate');
Route::get('/lien-he', [ClientController::class, 'lienhe'])->name('lienhe');
Route::post('/guilienhe', [ClientController::class, 'guilienhe'])->name('guilienhe');
Route::get('/blog', [BogController::class, 'blog'])->name('blog');
Route::post('/binhluan', [BinhLuanController::class, 'store'])->name('binhluan');
Route::get('/payment/create/{order_id}/{amount}/{order_info}', [VNPayController::class, 'createPayment'])->name('payment.create');
Route::get('/payment/return', [VNPayController::class, 'paymentReturn'])->name('payment.return');
Route::post('/coupons/apply', [CouponController::class, 'apply'])->name('coupons.apply');
Route::get('/coupons/remove', [CouponController::class, 'remove'])->name('coupons.remove');







Route::resource('client', ClientController::class);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
