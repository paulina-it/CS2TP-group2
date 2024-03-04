<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index() {
        $coupons = Coupon::all();
        return view('admin/admin-coupons',[
            'coupons' => $coupons
        ]);
    }

    public function create() {
        $coupon = new Coupon;
        $coupon->coupon_name = request('name');
        $coupon->discount = request('discount');
        $coupon->expiry_date = request('date');
        $coupon->save();
        return redirect('admin/coupons');
    }

    public function store(Request $request) {
        $coupon = Coupon::where('coupon_name', request('name'))->first();
        if (!$coupon) {
            return redirect('order');
        } 
        $request->session()->put('coupon', [
            'name' => $coupon['coupon_name'],
            'discount' => $coupon['discount']
        ]);
        return redirect('order');
    }

    public function delete(Request $request) {
        $request->session()->forget('coupon');
        return redirect('order');
    }
}
