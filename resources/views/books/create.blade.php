@extends('layouts.app')
@section('localVite')
    @vite(['resources/assets/js/bookForm.js'])
@endsection
@section('main')
    <div class="main">
        <div class="create-book-wrapper -with-sidebar">
            {{-- @include('layouts.admin-sidebar') --}}
            <div class="add-book-div flex flex-col p-4">
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
                    @csrf
                    <h1 class="text-center">Add a Book to Inventory</h1>
                    <label class="font-bold">Name</label>
                    <input type="text" placeholder="Name" name="name" />
                    <label class="font-bold">Author</label>
                    <input type="text" placeholder="Author" name="author" />
                    <label class="font-bold">Genre</label>
                    <input type="text" placeholder="Genre" name="genre" />
                    <label class="font-bold">Description</label>
                    <textarea rows="15" type="text" placeholder="Description" name="description"></textarea>
                    <label class="font-bold">Language</label>
                    <select name="language" id="language" class="mt-2">
                        <option value="russian">Russian</option>
                        <option value="polish">Polish</option>
                        <option value="urdu">Urdu</option>
                        <option value="punjabi">Punjabi</option>
                        <option value="romanian">Romanian</option>
                        <option value="spanish">Spanish</option>
                        <option value="latin">Latin</option>
                    </select>
                    <label class="font-bold">Price</label>
                    <input type="number" placeholder="Price" step="0.001" name="price">
                    <label class="font-bold">ISBN</label>
                    <input type="number" placeholder="ISBN" name="isbn" />
                    <label class="font-bold">Type</label>
                    <select name="type" id="type">
                        <option value="ebook">Ebook</option>
                        <option value="paperback">Paperback</option>
                        <option value="hardcover">Hardcover</option>
                    </select>
                    <label class="font-bold">Stock</label>
                    <input type="number" placeholder="Stock" name="stock" id="">
                    <label class="font-bold">Main image</label>
                    <input id="main-img-upload" type="file" name="mainImage" id="mainImage">
                    <img class="book-form-preview" id="main-img-preview" src="#" alt="..."
                        style="display: none" />
                    <label class="font-bold">Other Images</label>
                    <input id="other-img-upload" type="file" name="otherImages[]" id="otherImages" multiple>
                    <div id="other-images-preview" class="flex ">

                    </div>
                    <button type="submit">Sumbit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
