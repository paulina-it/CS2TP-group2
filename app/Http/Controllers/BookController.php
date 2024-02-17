<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use Carbon\Carbon;

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
            'category' => null,
            'selectedLanguages' => [],
            'selectedStock' => []
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
            'search' => null,
            'selectedLanguages' => [],
            'selectedStock' => []
        ]);
    }

    public function indexFilter() {
        $stock = request('stock');
        $languages = request('lang');
        $selectedLanguages = request('lang') ?? []; // Retrieve selected languages or default to an empty array
        $selectedStock = request('stock') ?? 'all-stock'; // Retrieve selected stock or default to 'all-stock'
    
    
        $query = Book::query();
    
        if (is_array($languages) && count($languages) > 0) {
            $query->whereIn('language', $languages);
        }
    
        if ($stock == 'in-stock') {
            $query->where('quantity', '>', 0);
        } elseif ($stock == 'not-in-stock') {
            $query->where('quantity', '<=', 0);
        }
    
        $books = $query->get();
    
        return view('books/index', [
            'books' => $books,
            'category' => null,
            'search' => null,
            'selectedLanguages' => $selectedLanguages,
            'selectedStock' => $selectedStock
        ]);
    }

    public function sort() {
        $sortType = request('sort');
        $books = Book::query();

        $sort = explode('-', $sortType);
        $field = $sort[0]; 
        $order = $sort[1]; 

        if ($field === 'price') {
            $books->orderBy('price', $order);
        } elseif ($field === 'date') {
            $books->orderBy('created_at', $order);
        }

        $sortedBooks = $books->get();

        return view('books/index', [
            'books' => $sortedBooks,
            'category' => null,
            'search' => null,
            'selectedLanguages' => [],
            'selectedStock' => []
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
        $imageName = str_replace(' ', '', request('author').Carbon::now()->toDateString().$image->getClientOriginalName());
        $dest = '../images';
        $request->file('mainImage')->storeAs('public', $imageName);
        // $image->move(public_path($dest), $imageName);
        $otherImageNames = array();
        foreach(request('otherImages') as $otherImage) {
        	$otherImageName = str_replace(' ', '', request('author').Carbon::now()->toDateString().$otherImage->getClientOriginalName());
            $otherImage->storeAs('public', $otherImageName);
            // $otherImage->move(public_path($dest), $otherImageName);
            array_push($otherImageNames, $otherImageName);
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
        return redirect('admin/');
    }

    //hosted previous version 
    // public function store(Request $request) {
    //     $image = $request->file('mainImage');
    //     $imageName = $image->getClientOriginalName();
    //     $dest = '../images';
    //     $image->storeAs('public', $imageName);
    //     $image->move(public_path($dest), $imageName);
    //     $otherImageNames = array();
    //     foreach(request('otherImages') as $otherImage) {
    //         $otherImage->storeAs('public', $otherImage->getClientOriginalName());
    //         $otherImage->move(public_path($dest), $otherImage->getClientOriginalName());
    //         array_push($otherImageNames, $otherImage->getClientOriginalName());
    //     }
    //     $book = new Book();
    //     $book->book_name = request('name');
    //     $book->genre = request('genre');
    //     $book->description = request('description');
    //     $book->author = request('author');
    //     $book->language = request('language');
    //     $book->type = request('type');
    //     $book->price = request('price');
    //     $book->quantity = request('stock');
    //     $book->mainImage = $imageName;
    //     $book->otherImages = json_encode($otherImageNames);
    //     $book->ISBN = request('isbn');
    //     $book->save();
    //     return redirect('books');
    // }

    public function edit($id) {
        $book = Book::findOrFail($id);
        return view('books/edit', [
            'book' => $book
        ]);
    }

    public function save($id, Request $request) {
        if ($request->file('mainImage') != null) {
            $image = $request->file('mainImage');
            $imageName = $image->getClientOriginalName();
            $request->file('mainImage')->storeAs('public', $imageName);
        }
        if (request('otherImages') != null) {
            $otherImageNames = array();
            foreach(request('otherImages') as $otherImage) {
                $otherImage->storeAs('public', $otherImage->getClientOriginalName());
                array_push($otherImageNames, $otherImage->getClientOriginalName());
            }
        }
        $book = Book::findOrFail($id);
        $book->book_name = request('name');
        $book->genre = request('genre');
        $book->description = request('description');
        $book->author = request('author');
        $book->language = request('language');
        $book->type = request('type');
        $book->price = request('price');
        $book->quantity = request('stock');
        if ($request->file('mainImage') != null) {
            $book->mainImage = $imageName;
        }
        if (request('otherImages') != null) {
            $book->otherImages = json_encode($otherImageNames);
        }
        $book->ISBN = request('ISBN');
        $book->save();
        return redirect('admin/books');
    }

    public function destroy($id) {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('admin-books');
    }

}
