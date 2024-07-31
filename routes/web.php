<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\LienHeController;
use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\DonHangController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\ThongKeController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Admin\BaiVietController as AdminBaiVietController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('login', [AuthController::class, 'showFormlogin']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'showFormRegister']);
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
});


Route::middleware(['auth', 'auth.admin'])->prefix('admins')
    ->as('admins.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admins.dashboard');
        })->name('dashboard');
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

        Route::prefix('lienhe')
            ->as('lienhe.')
            ->group(function () {
                Route::get('/', [LienHeController::class, 'index'])->name('index');
                Route::get('/create', [LienHeController::class, 'create'])->name('create');
                Route::post('/store', [LienHeController::class, 'store'])->name('store');
                Route::get('/show/{id}', [LienHeController::class, 'show'])->name('show');
                Route::get('{id}/edit', [LienHeController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [LienHeController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [LienHeController::class, 'destroy'])->name('destroy');
            });
        Route::prefix('users')
            ->as('users.')
            ->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/create', [UserController::class, 'create'])->name('create');
                Route::post('/store', [UserController::class, 'store'])->name('store');
                Route::get('/show/{id}', [UserController::class, 'show'])->name('show');
                Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [UserController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [UserController::class, 'destroy'])->name('destroy');
            });


        // Route để hiển thị danh sách đơn hàng
        Route::get('/donhang', [DonHangController::class, 'index'])->name('donhang');

        Route::get('/dashboard', [ThongKeController::class, 'index'])->name('dashboard');

        // Route để hiển thị chi tiết đơn hàng
        Route::get('/donhang/{id}', [DonHangController::class, 'show'])->name('chitietdonhang');
        // Route để cập nhật trạng thái đơn hàng
        Route::put('/donhang/{id}', [DonHangController::class, 'update'])->name('capnhatdonhang');
    });

Route::get('details{id}', [ClientController::class, 'details'])->name('details');
Route::get('/list-cart', [CartController::class, 'listCart'])->name('cart.list');
Route::post('/add-to-cart', [CartController::class, 'addCart'])->name('cart.add');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/clearCart', [CartController::class, 'clearCart'])->name('clearCart');
Route::get('/shop', [ClientController::class, 'shop'])->name('shop');


Route::resource('client', ClientController::class);

