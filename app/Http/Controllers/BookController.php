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
            $books = Book::where(function ($query) use($search) {
                $query->where('book_name', 'like', '%' . $search . '%')
                ->orWhere('author', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('genre', 'like', '%' . $search . '%')
                ->orWhere('language', 'like', '%' . $search . '%');
            })->get();
        }
        return view('books/index', [
            'books' => $books,
            'search' => $search,
            'category' => null
        ]);
    }

    public function indexCategory($category_slug) {
        $books = Book::where(function ($query) use($category_slug) {
            $query->where('language', 'like', '%' . $category_slug . '%')
            ->orWhere('genre', 'like', '%' . $category_slug . '%');
        })->get();
        
        return view('books/index', [
            'books' => $books,
            'category' => $category_slug,
            'search' => null
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
        $book->type = request('type');
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
        $book->book_name = request('name');
        $book->genre = request('genre');
        $book->description = request('description');
        $book->author = request('author');
        $book->language = request('language');
        $book->type = request('type');
        $book->price = request('price');
        $book->quantity = request('stock');
        //add image
        $book->ISBN = request('isbn');
        $book->save();
        return view('books/show', ['book' => $book]);
    }

    public function destroy($id) {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index');
    }
}
