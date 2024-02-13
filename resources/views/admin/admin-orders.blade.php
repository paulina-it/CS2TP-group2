@extends('layouts.app')

@section('main')
    <form action="{{ route('admin-orders') }}" method="GET">
    <label>Filter</label>
    <select name="filter">
        <option value="none">None</option>
        <option value="pending">Pending</option>
        <option value="processed">Processed</option>
        <option value="completed">Completed</option>
        <option value="shipping">Shipping</option>
        <option value="canceled">Canceled</option>
        <option value="refunded">Refunded</option>
    </select>
    <input type="text" name="idSearch">
    <input type="submit" value="submit">
    </form>
    @for ($i = 0; $i < count($orders); $i++)
        <div>
        <form action="{{ route('admin-process', $orders[$i]['id']) }}" method="POST">
            @csrf
            <select name="status">
                <option value="pending" <?php if($orders[$i]['status'] == "pending"){echo("selected");} ?> >Pending</option>
                <option value="processed" <?php if($orders[$i]['status'] == "processed"){echo("selected");} ?> >Processed</option>
                <option value="completed" <?php if($orders[$i]['status'] == "completed"){echo("selected");} ?> >Completed</option>
                <option value="shipping" <?php if($orders[$i]['status'] == "shipping"){echo("selected");} ?> >Shipping</option>
                <option value="canceled" <?php if($orders[$i]['status'] == "canceled"){echo("selected");} ?> >Canceled</option>
                <option value="refunded" <?php if($orders[$i]['status'] == "refunded"){echo("selected");} ?> >Refunded</option>
            </select>
            <label>{{ $users[$i][0]['id'] }}</label>
            <label>{{ $users[$i][0]['firstName'] }}</label>
            <label>{{ $users[$i][0]['email'] }}</label>
            <label>{{ $users[$i][0]['phone'] }}</label>
            <input type="submit" value="Process">
        </form>
        </div>
        <br>
    @endfor
@endsection
