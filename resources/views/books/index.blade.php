<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/assets/sass/app.scss', 'resources/js/app.js'])
        
    </head>
    <body style="color: aliceblue">
        @include('layouts.navigation')
        <form action="{{ route('books.index') }}" method="GET" class="card mb-3">
            <div class="card-body">
                <input type="text" placeholder="Search" name="search" class="form-control card-title">
                
                <input type="submit" class="btn btn-primary">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="searchBy" value="name" id="name" checked>
                    <label class="form-check-label" for="name">
                        Name
                    </label>
                </div>
                @if(!empty($search))
                <label style="color: aliceblue">Search results for {{ $search }}</label><br>
                <a  style="color: aliceblue" href="{{ route('books.index') }}">Clear Search</a>
                @endif
            </div>
        </form>
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