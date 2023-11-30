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
            <form action="{{ route('books.save', $book->id) }}" method="POST">
                @csrf
                <input type="text" value="{{ $book->name }}" name="name">
                <input type="text" value="{{ $book->genre }}" name="genre">
                <input type="text" value="{{ $book->description }}" name="description">
                <input type="text" value="{{ $book->author }}" name="author">
                <input type="text" value="{{ $book->image }}" name="image">
                <input type="number" value="{{ $book->price }}" name="price">
                <input type="number" value="{{ $book->stock }}" name="stock">
                <input type="submit" value="submit">
            </form>
            <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete">
        </main>
    </body>
</html>