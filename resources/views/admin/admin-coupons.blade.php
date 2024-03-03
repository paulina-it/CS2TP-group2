@extends('layouts.app')

@section('main')
<div>
    @foreach ($coupons as $coupon)
        <div>
            <label>{{ $coupon['coupon_name'] }}</label>
            <label>{{ $coupon['discount'] }}</label>
            <label>{{ $coupon['expiry_date'] }}</label>
        </div>    
    @endforeach
    <form action="{{ route('admin-coupons-create') }}" method="POST">
        @csrf
        <input type="text" name="name">
        <input type="number" name="discount">
        <input type="date" name="date">
        <input type="submit" value="Submit">
    </form>
</div>
@endsection