<?php

namespace App\Http\Controllers\Client;

<<<<<<< HEAD
use App\Models\Banner;
=======
use App\Models\LienHe;
use App\Models\DanhMuc;
use App\Models\lien_he;
>>>>>>> df8a2f79dd83fe570aaa4887cef11e1d46d49be5
use App\Models\SanPham;
use App\Mail\MailConfirm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Mail;
>>>>>>> df8a2f79dd83fe570aaa4887cef11e1d46d49be5

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
           

        return view("clients.index", compact('listSanPham','listSlider'));
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
        $listSanPham = SanPham::query()
            ->when($search, function ($query, $search) {
                return $query->where("ten_san_pham", "like", "%{$search}%");
            })
            ->get();
        return view('clients.sanpham.shop', compact('listSanPham'));
    }
    public function myaccount(Request $request)
    {

        return view('clients.myaccount.myaccount');
    }
    public function lienhe(Request $request)
    {

        return view('clients.contact.lienhe');
    }
    // public function guilienhe(Request $request)
    // {


    //     if ($request->isMethod('POST')) {
    //         $params = $request->except('_token');
    //         $lien_He =lien_he::create($params);

    //         return redirect()->route('lienhe')->with('success', 'Bạn đã gửi thành công !');
    //     }
    //     dd($request->all());
    // }

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
        Mail::to('quanndph41110@fpt.edu.vn')->send(new MailConfirm($validatedData,$images));
    
        // Redirect with success message
        return redirect()->route('lienhe')->with('success', 'Bạn đã gửi thành công !');
    }
    
}
