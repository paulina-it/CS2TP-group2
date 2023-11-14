<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index() {
        $books = Book::all();
        return view('books/index', [
            'books' => $books
        ]);
    }
    public function show($id) {
        $book = Book::findOrFail($id);
        return view('books/show', [
            'book' => $book
        ]);
    }
    public function create() {
        return view('books/create');
    }
    public function store() {
        $book = new Book();
        $book->name = request('name');
        $book->genre = request('genre');
        $book->description = request('description');
        $book->author = request('author');
        $book->image = request('image');
        $book->price = request('price');
        $book->stock = request('stock');
        $book->save();
        return redirect('books');
    }

    public function edit($id) {
        $book = Book::findOrFail($id);
        return view('books/edit', [
            'book' => $book
        ]);
    }

    public function save($id) {
        $book = Book::findOrFail($id);
        $book->name = request('name');
        $book->genre = request('genre');
        $book->description = request('description');
        $book->author = request('author');
        $book->image = request('image');
        $book->price = request('price');
        $book->stock = request('stock');
        $book->save();
        return view('books/show', ['book' => $book]);
    }
}
