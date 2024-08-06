<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('admins.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admins.coupons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons',
            'discount' => 'required|numeric',
            'expires_at' => 'nullable|date',
        ]);

        Coupon::create($request->all());

        return redirect()->route('admins.coupons.index')
                         ->with('success', 'Coupon created successfully.');
    }

    public function show(Coupon $coupon)
    {
        return view('admins.coupons.show', compact('coupon'));
    }

    public function edit(Coupon $coupon)
    {
        return view('admins.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'discount' => 'required|numeric',
            'expires_at' => 'nullable|date',
        ]);

        $coupon->update($request->all());

        return redirect()->route('admins.coupons.index')
                         ->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('admins.coupons.index')
                         ->with('success', 'Coupon deleted successfully.');
    }
}
