@extends('layouts.app')
@section('main')

@for ($i = 0; $i < count($orders); $i++)
    <div>
    @foreach ($books as $book)
        @if($book[0] == $i) 
            <div class="cart-info flex checkout-book">
                <img class="opened-preview book-img-mini" src="{{ asset('storage/' . $book[1][0]['mainImage']) }}"
                    alt="{{ $book[1][0]['book_name'] }}">
                <div>
                    <p> {{ $book[1][0]['book_name'] }}</p>
                    {{-- <small>£{{ $books[$i][0]['price'] }}</small> --}}
                </div>
                <form action="{{ route('order.return', $orders[$i]['order_id']) }}" method="POST">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Return">
                </form>
            </div>
        @endif
    @endforeach
    <label>{{ $orders[$i]['status'] }}</label>
    </div>
@endfor

@endsection