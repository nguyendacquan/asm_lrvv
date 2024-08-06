<?php

namespace App\Http\Controllers\Client;

use App\Models\User;

use App\Models\Banner;
use App\Models\LienHe;
use App\Models\DanhMuc;
use App\Models\SanPham;
use App\Mail\MailConfirm;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input("search");
        $listSanPham = SanPham::query()
            ->when($search, function ($query, $search) {
                return $query->where("ten_san_pham", "like", "%{$search}%");
            })
            ->get();
        $listSlider = Banner::where('status', 1)->get();
        return view("clients.index", compact('listSanPham', 'listSlider'));
    }

    public function show(String $id)
    {
        $sanPham = SanPham::query()->findOrFail($id);
        $listSanPham = SanPham::query()->get();
        return view('clients.sanpham.details', compact('sanPham', 'listSanPham'));
    }

    public function shop(Request $request)
    {
        $search = $request->input("search");
        $categoryId = $request->input('danh_muc_id');


        $listDanhMuc = DanhMuc::orderByDesc('trang_thai')->get();


        $listSanPham = SanPham::query()
            ->when($search, function ($query, $search) {
                return $query->where("ten_san_pham", "like", "%{$search}%");
            })
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('danh_muc_id', $categoryId);
            })
            ->paginate(16);

        $totalProducts = $listSanPham->total();


        return view('clients.sanpham.shop', compact('listSanPham', 'listDanhMuc', 'totalProducts'));
    }

    public function myaccount()
    {
        $user = Auth::user();
        return view('clients.myaccount.index', compact('user'));
    }
    public function myEdit(String $id)
    {
        $user = Auth::user();
        return view('clients.myaccount.edit', compact('user'));
    }
    public function myUpdate(Request $request, String $id)
    {

        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');
            $user = User::find($id);
            $user->update($params);
            return redirect()->route('myaccount')->with('success', 'Cập nhật thông tin thành công');
        }
    }


    public function lienhe(Request $request)
    {

        return view('clients.contact.lienhe');
    }


    public function guilienhe(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'ho_va_ten' => 'required|string|max:255',
            'email' => 'required|email',
            'chu_de' => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|max:20',
            'message' => 'required|string',
            'images' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',

        ]);
        $images = null;
        if ($request->hasFile('images')) {
            // Store the image file and get its path
            $images = $request->file('images')->store('uploads/images', 'public');
        }
        // Send email
        Mail::to('quanndph41110@fpt.edu.vn')->send(new MailConfirm($validatedData, $images));

        // Redirect with success message
        return redirect()->route('lienhe')->with('success', 'Bạn đã gửi thành công !');
    }
}
