<?php

use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\LienHeController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Clients\checkout;
use App\Http\Controllers\Clients\test;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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

// Route::get('/admin', function () {
//     return "Đây là trang admin";
// })->middleware(['auth', 'auth.admin']);

// Route::middleware('auth')->group(function () {
//     Route::get('/home', function () {
//         return view('home');
//     });

//     Route::middleware('auth.admin')->group(function () {
//         Route::get('/admin', function () {
//             return "Đây là trang admin !";
//         });
//     });

// });

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
    });


Route::get('details{id}', [ClientController::class, 'details'])->name('details');
Route::get('cart{id}', [ClientController::class, 'cart'])->name('cart');
Route::get('myaccount', [ClientController::class, 'myaccount'])->name('myaccount');
Route::resource('clients', ClientController::class);
