@extends('layouts.app')

@section('main')
    <div class="main">
        <div class="add-book-div flex flex-col p-4">
        <form action="{{ route('books.save', $book->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
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
            <label class="font-bold">Book type</label>
            <input type="text" value="{{ $book->type }}" name="type">
            <label class="font-bold">Language</label>
            <input type="text" value="{{ $book->language }}" name="language">
            <label class="font-bold">ISBN</label>
            <input type="text" value="{{ $book->ISBN }}" name="ISBN">
            <label>{{$book->mainImage}}</label>
            <input type="file" name="mainImage">
            <label>{{$book->otherImages}}</label>
            <input type="file" name="otherImages[]" id="otherImages" multiple>
            <label class="font-bold">Price</label>
            <input type="number" value="{{ $book->price }}" name="price">
            <label class="font-bold">Stock</label>
            <input type="number" value="{{ $book->quantity }}" name="stock">
            {{-- <input type="submit" value="submit"> --}}
            <button type="submit" value="submit">Submit Changes</button>
        </form>
        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <h4>Remove book from inventory</h4>
            <button type="submit" value="Delete" id="red-btn">Delete</button>
            {{-- <input type="submit" value="Delete"> --}}
        </form>
    </div>
    </div>
@endsection
