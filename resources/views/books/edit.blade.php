@extends('layouts.app')

@section('main')
    <div class="main">
        <div class="add-book-div flex flex-col p-4">
            
        <form action="{{ route('books.save', $book->id) }}" method="POST" class="flex flex-col">
            @csrf
            <h1 class="text-center">Edit "{{$book->book_name}}"</h1>
            <label class="font-bold">Name</label>
            <input type="text" value="{{ $book->book_name }}" name="name">
            <label class="font-bold">Genre</label>
            <input type="text" value="{{ $book->genre }}" name="genre">
            <label class="font-bold">Description</label>
            <input type="text" value="{{ $book->description }}" name="description">
            <label class="font-bold">Author</label>
            <input type="text" value="{{ $book->author }}" name="author">
            <label class="font-bold">ISBN</label>
            <input type="text" value="{{ $book->ISBN }}" name="ISBN">
            <label class="font-bold">Main image</label>
            <input type="file" value="{{ $book->mainImage }}" name="mainImage">
            <label class="font-bold">Price</label>
            <input type="number" value="{{ $book->price }}" name="price">
            <label class="font-bold">Stock</label>
            <input type="number" value="{{ $book->stock }}" name="stock">
            <button type="submit" value="submit">Submit Changes</button>
        </form>
        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <h4>Remove book from inventory</h4>
            <button type="submit" value="Delete" id="red-btn">Delete</button>
        </div>
        </div>
@endsection
