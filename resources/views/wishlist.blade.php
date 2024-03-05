
@extends('layouts.app')
@section('main')

<div class="wishlist-main">

    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif

    <h1 class="title">Wishlist</h1>

    <div class="small-container wishlist">
        <table>
            <tr>
                <th>Product</th>
                <th>Stock</th>
                <th></th>
            </tr>
            @if (count($books) > 0)
                @for ($i = 0; $i < count($books); $i++)
                    <tr>
                        <td>
                            <div class="wish">
                                <img class="opened-preview book-img-mini"
                                    src="{{ asset('storage/' . $books[$i][0]['mainImage']) }}"
                                    alt="{{ $books[$i][0]['book_name'] }}">
                                <div>
                                    <p class="name">{{ $books[$i][0]['book_name'] }}</p>
                                    <small>Price: £{{ $books[$i][0]['price'] }}</small>
                                    <br>
                                </div>
                            </div>
                        </td>
                        <td>
                        @if ($books[$i][0]['quantity'] > 0)
                            <div class="book-stock">
                                <p class="book-stock-text">In stock</p>
                            </div>
                        @else
                            <div class="book-stock">
                                <p class="book-stock-text" class="text-xs">Not in stock</p>
                            </div>
                        @endif
                        </td>
                        <td>
                        
                        <form action="{{ route('wishlist.basket', $books[$i][0]['id']) }}"
                            method="POST">
                            @csrf
                            @if ($books[$i][0]['quantity'] > 0)
                            <button>Add to cart</button>
                            @else
                            <button disabled>Add to cart</button>
                            @endif
                        </form>
                        <form action="{{ route('wishlist.destroy', $books[$i][0]['id']) }}"
                            method="POST">
                            @csrf
                            @method('delete')
                            <button>Remove</button>
                        </form>
                        </td>
                    </tr>
                @endfor
            @else
                <td>
                    <h4>Wishlist is empty</h4>
                </td>
            @endif
        </table>
    </div>
</div>

@endsection