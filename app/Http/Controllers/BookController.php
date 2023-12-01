<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;

class BookController extends Controller
{
    public function index() {
        $search = request('search');
        if (empty($search)) {
            $books = Book::all();
        } else {
            $books = Book::where(request('searchBy'), 'LIKE', '%'.$search.'%')->get();
        }
        return view('books/index', [
            'books' => $books,
            'search' => $search
        ]);
    }
    public function show($id) {
        $book = Book::findOrFail($id);
        $otherBooksInLanguage = Book::where('language', $book['language'])->where('id', '!=', $id)->get();
        return view('books/show', [
            'book' => $book
        ], compact('book', 'otherBooksInLanguage'));
    }
    public function create() {
        return view('books/create');
    }
    public function store(Request $request) {
        $image = $request->file('mainImage');
        $imageName = $image->getClientOriginalName();
        $request->file('mainImage')->storeAs('public', $imageName);
        $otherImageNames = array();
        foreach(request('otherImages') as $otherImage) {
            $otherImage->storeAs('public', $otherImage->getClientOriginalName());
            array_push($otherImageNames, $otherImage->getClientOriginalName());
        }
        $book = new Book();
        $book->book_name = request('name');
        $book->genre = request('genre');
        $book->description = request('description');
        $book->author = request('author');
        $book->language = request('language');
        $book->price = request('price');
        $book->quantity = request('stock');
        $book->mainImage = $imageName;
        $book->otherImages = json_encode($otherImageNames);
        $book->ISBN = request('isbn');
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

    public function destroy($id) {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index');
    }
}
