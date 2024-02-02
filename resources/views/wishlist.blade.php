@extends('layouts.app')
@section('main')

<div class="main">

    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif

    <h1 class="title">Wishlist</h1>

    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            @if (count($books) > 0)
                @for ($i = 0; $i < count($books); $i++)
                    <tr>
                        <td>
                            <a href="{{ route('books.show', $books[$i][0]['id']) }}">
                                <div class="cart-info">
                                    <img class="opened-preview book-img-mini"
                                        src="{{ asset('storage/' . $books[$i][0]['mainImage']) }}"
                                        alt="{{ $books[$i][0]['book_name'] }}">
                                    <div>
                                        <p>{{ $books[$i][0]['book_name'] }}</p>
                                        <small>£{{ $books[$i][0]['price'] }}</small>
                                        <br>
                                        <form action="{{ route('wishlist.destroy', $books[$i][0]['id']) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <button>Remove</button>
                                        </form>
                                        <form action="{{ route('wishlist.basket', $books[$i][0]['id']) }}"
                                            method="POST">
                                            @csrf
                                            <button>Add to cart</button>
                                        </form>
                                    </div>
                                </div>
                            </a>
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