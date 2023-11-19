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
        <form action="{{ route('books.store') }}" method="POST">
            @csrf
            <input type="text" placeholder="Name" name="name"/>
            <input type="text" placeholder="Genre" name="genre"/>
            <input type="text" placeholder="Description" name="description"/>
            <input type="text" placeholder="Author" name="author"/>
            <input type="text" placeholder="Image" name="image"/>
            <input type="number" placeholder="Price" name="price"/>
            <input type="number" placeholder="Stock" name="stock"/>
            <input type="submit" value="Submit"/>
        </form>
    </body>
</html>