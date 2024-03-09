@extends('layouts.app')

@section('main')
<div class="admin-order-div">
    <h1>Order #{{$order['id']}}</h1>
    <div class="order-details">
        <p>Ordered By: {{ $user['firstName']}}</p>
    </div>
</div>
@endsection
