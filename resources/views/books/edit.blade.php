@extends('layouts.app')

@section('main')
    <main>
        <form action="{{ route('books.save', $book->id) }}" method="POST" class="flex flex-col">
            @csrf
            <input type="text" value="{{ $book->book_name }}" name="name">
            <input type="text" value="{{ $book->genre }}" name="genre">
            <input type="text" value="{{ $book->description }}" name="description">
            <input type="text" value="{{ $book->author }}" name="author">
            <input type="text" value="{{ $book->ISBN }}" name="ISBN">
            <input type="file" value="{{ $book->mainImage }}" name="mainImage">
            <input type="number" value="{{ $book->price }}" name="price">
            <input type="number" value="{{ $book->stock }}" name="stock">
            <input type="submit" value="submit">
        </form>
        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete">
    </main>
@endsection
