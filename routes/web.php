<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\DonHangController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Admin\BaiVietController as AdminBaiVietController;
use App\Http\Controllers\Admin\BinhLuanController as AdminBinhLuanController;
use App\Http\Controllers\Client\BinhLuanController;
use App\Http\Controllers\Client\UserController as ClientUserController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('login', [AuthController::class, 'showFormlogin']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'showFormRegister']);
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->prefix('donhangs')
    ->as('donhangs.')
    ->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/create', [OrderController::class, 'create'])->name('create');
        Route::post('/store', [OrderController::class, 'store'])->name('store');
        Route::get('/show/{id}', [OrderController::class, 'show'])->name('show');
        Route::put('{id}/update', [OrderController::class, 'update'])->name('update');
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
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::delete('users/{id}/destroy', [UserController::class, 'softDelete'])->name('softDelete');
                Route::get('users/deleted', [UserController::class, 'deleted'])->name('deleted');
                Route::post('users/{id}/restore', [UserController::class, 'restore'])->name('restore');
                Route::delete('users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('force-delete');
                Route::post('users/{user}/update', [UserController::class, 'updateStatus'])->name('updateStatus');
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
    });

Route::get('details{id}', [ClientController::class, 'details'])->name('details');
Route::get('/list-cart', [CartController::class, 'listCart'])->name('cart.list');
Route::post('/add-to-cart', [CartController::class, 'addCart'])->name('cart.add');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/clearCart', [CartController::class, 'clearCart'])->name('clearCart');
Route::get('/shop', [ClientController::class, 'shop'])->name('shop');
Route::get('/shop', [ClientController::class, 'shop'])->name('shop');
Route::get('/profile', [ClientUserController::class, 'edit'])->name('profile.edit');
Route::post('/profile', [ClientUserController::class, 'update'])->name('profile.update');
Route::get('/lien-he', [ClientController::class, 'lienhe'])->name('lienhe');
Route::post('/guilienhe', [ClientController::class, 'guilienhe'])->name('guilienhe');
Route::post('/binhluan', [BinhLuanController::class, 'store'])->name('binhluan');


Route::resource('client', ClientController::class);
