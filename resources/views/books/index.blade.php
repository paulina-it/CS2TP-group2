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
        @foreach ($books as $book)
            <a href="{{ route('books.show', $book['id']) }}">
                <div class="bg-darkWhite text-center p-4">
                    <img src="{{ URL("/img/{$book->image}") }}" />
                    <p>{{ $book['name'] }}</p>
                    <p>{{ $book['description'] }}</p>
                    <p>{{ $book['author'] }}</p>
                    <p>£{{ $book['price'] }}</p>
                </div>
            </a>
        @endforeach
    </body>
</html>