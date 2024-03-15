<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index() {
        $coupons = Coupon::paginate(20);
        return view('admin/admin-coupons',[
            'coupons' => $coupons
        ]);
    }

    public function create(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'discount' => ['required', 'int'],
            'date' => ['required', 'date'],
        ]);
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
            return redirect('order')->withErrors(['msg' => 'Please enter valid code']);
        } 
        $date = $coupon['expiry_date'];
        $today = date("Y-m-d");
        if ($date < $today) {
            $expired = true;
        } else {
            $expired = false;
        }
        if ($expired) {
            return redirect('order')->withErrors(['msg' => 'Please enter valid code']);
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
