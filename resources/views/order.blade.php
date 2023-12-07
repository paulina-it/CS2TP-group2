<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/assets/sass/app.scss', 'resources/js/app.js'])
        
    </head>
    <body>
        @include('layouts.navigation')
        @for ($i = 0; $i < count($books); $i++)
            <p>{{ $books[$i][0]['book_name'] }}</p>
            <p>{{ $books[$i][0]['price'] }}</p>
        @endfor
        <form action="{{route('order.create')}}" method="POST">
            @csrf
            <label for="credit_card_no">Credit Card Number</label>
            <input name="credit_card_no" type="number">
            <input type="submit" value="Complete Order">
        </form>
    </body>
</html>