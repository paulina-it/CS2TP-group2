@extends('layouts.app')

@section('main')
    <main>
        <form action="{{ route('books.save', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" value="{{ $book->book_name }}" name="name">
            <input type="text" value="{{ $book->genre }}" name="genre">
            <input type="text" value="{{ $book->description }}" name="description">
            <input type="text" value="{{ $book->author }}" name="author">
            <input type="text" value="{{ $book->type }}" name="type">
            <input type="text" value="{{ $book->language }}" name="language">
            <input type="text" value="{{ $book->ISBN }}" name="ISBN">
            <label>{{$book->mainImage}}</label>
            <input type="file" name="mainImage">
            <label>{{$book->otherImages}}</label>
            <input type="file" name="otherImages[]" id="otherImages" multiple>
            <input type="number" value="{{ $book->price }}" name="price">
            <input type="number" value="{{ $book->quantity }}" name="stock">
            <input type="submit" value="submit">
        </form>
        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete">
        </form>
    </main>
@endsection
