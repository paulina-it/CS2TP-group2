<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/assets/sass/app.scss', 'resources/js/app.js'])
        
    </head>
    <body>
        @php
            $total = 0;
        @endphp 
        @include('layouts.navigation')
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        @for ($i = 0; $i < count($books); $i++)
            <p>{{ $books[$i][0]['book_name'] }}</p>
            <p>{{ $books[$i][0]['description'] }}</p>
            <p>{{ $books[$i][0]['author'] }}</p>
            <p>{{ $books[$i][0]['price'] }}</p>
            <form action="{{ route('basket.destroy', $books[$i][0]['id']) }}" method="POST">
                @csrf
                @method('delete')
                <input type="submit" value="Remove"/>
            </form>
            @php
            $total += $books[$i][0]['price'];
            @endphp   
        @endfor
        <p>Total: £{{$total}}</p>
        <form action="{{route('order.index')}}" method="GET">
            @csrf
            <input type="submit" value="Order">
        </form>
    </body>
</html>