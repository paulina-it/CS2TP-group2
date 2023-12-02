@extends('layouts.app')

@section('main')
    <div class="main">
        <div class="add-book-div flex flex-col p-4">
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
                @csrf
                <h1 class="text-center">Add a Book to Inventory</h1>
                <input type="text" placeholder="Name" name="name" />
                <input type="text" placeholder="Genre" name="genre" />
                <textarea type="text" placeholder="Description" name="description"></textarea>
                <input type="text" placeholder="Author" name="author" />
                <select name="language" id="language">
                    <option value="russian">Russian</option>
                    <option value="polish">Polish</option>
                    <option value="urdu">Urdu</option>
                    <option value="punjabi">Punjabi</option>
                    <option value="romanian">Romanian</option>
                    <option value="spanish">Spanish</option>
                    <option value="latin">Latin</option>
                </select>
                <input type="number" placeholder="Price" step="0.001" name="price">
                <input type="number" placeholder="ISBN" name="isbn" />
                <select name="type" id="type">
                    <option value="ebook">Ebook</option>
                    <option value="paperback">Paperback</option>
                    <option value="hardcover">Hardcover</option>
                </select>
                <input type="number" placeholder="Stock" name="stock" id="">
                <label>Main image</label>
                <input type="file" name="mainImage" id="mainImage">
                <label>Other Images</label>
                <input type="file" name="otherImages[]" id="otherImages" multiple>
                <button type="submit">Sumbit</button>
            </form>
        </div>
    </div>
@endsection
