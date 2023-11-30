<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/images/No text white logo.png" type="image/png">
    <title>flippinpages</title>

    @vite(['resources/assets/sass/app.scss', 'resources/js/app.js'])
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</head>

<body>
    @include('layouts.navigation')
    <div class="content">
        <div class="flex flex-col p-4">
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" placeholder="Name" name="name"/>
            <input type="text" placeholder="Genre" name="genre"/>
            <input type="text" placeholder="Description" name="description"/>
            <input type="text" placeholder="Author" name="author"/>
            <input type="number" placeholder="ISBN" name="isbn"/>
            <label>Main image</label>
            <input type="file" name="mainImage" id="mainImage">
            <label>Other Images</label>
            <input type="file" name="otherImages[]" id="otherImages" multiple>
            <input type="submit" value="Submit"/>
        </form>
        </div>
    </div>
</body>
</html>