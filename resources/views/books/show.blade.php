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
        <main>
            <p>{{ $book['name'] }}</p>
            <p>{{ $book['description'] }}</p>
            <p>{{ $book['author'] }}</p>
            <p>£{{ $book['price'] }}</p>
            <form action="{{ route('basket.store', $book['id']) }}" method="POST">
                @csrf
                <input type="submit" value="Add to basket"/>
            </form>
        </main>
    </body>
</html>