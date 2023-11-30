<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/assets/sass/app.scss', 'resources/js/app.js'])
        
    </head>
    <body style="color: black">
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
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="searchBy" value="genre" id="genre">
                    <label class="form-check-label" for="genre">
                        Genre
                    </label>
                </div>
                @if(!empty($search))
                <label style="color: black">Search results for {{ $search }}</label><br>
                <a  style="color: black" href="{{ route('books.index') }}">Clear Search</a>
                @endif
            </div>
        </form>
        
        @foreach ($books as $book)
            <?php 
                $otherImages = json_decode($book['otherImages'])
                
            ?>
            <a href="{{ route('books.show', $book['id']) }}">
                <div style="color:black;" class="bg-darkWhite text-center p-4">
                    <p>{{ $book['name'] }}</p>
                    <p>{{ $book['description'] }}</p>
                    <p>{{ $book['author'] }}</p>
                    <img style="width: 50px" src="{{ asset('storage/'.$book['mainImage']) }}">
                    @foreach ($otherImages as $otherImage)
                    <img style="width: 50px" src="{{ asset('storage/'.$otherImage) }}">
                    @endforeach
                </div>
            </a>
        @endforeach
        
    </body>
</html>