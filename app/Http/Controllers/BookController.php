<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use App\Models\ProductRating;

class BookController extends Controller
{
    public function index($category_slug = null) {
        if (session()->get('sort') != null ) {
            $sortType = session()->get('sort', 'price-asc'); }
        else {
            $sortType = 'price-asc';
        }
        $search = request('search');
        if ($category_slug === null) {
            $category_slug = Session::get('category');
        } else if ($category_slug == '') {
            $this->setCategory('');
        }
        $stock = request('stock');
        $languages = request('lang');
        $selectedLanguages = request('lang') ?? []; 
        $selectedStock = request('stock') ?? 'all-stock'; 
    
        $query = Book::query();
    
        if (!empty($search)) {
                $query->where('book_name', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
                    // ->orWhere('genre', 'like', '%' . $search . '%')
                    // ->orWhere('language', 'like', '%' . $search . '%');
            
        } 

        if ($category_slug != null) {
            $query->where(function($query) use ($category_slug) {
                $query->where('language', 'like', '%' . $category_slug . '%')
                    ->orWhere('genre', 'like', '%' . $category_slug . '%');
            });
        }

        if (is_array($languages) && count($languages) > 0) {
            $query->whereIn('language', $languages);
        }
    
        if ($stock == 'in-stock') {
            $query->where('quantity', '>', 0);
        } elseif ($stock == 'not-in-stock') {
            $query->where('quantity', '<=', 0);
        }

        // $books = $query->get();
        // $query->paginate(12);
        $sortedBooks = $this->sort($query, $sortType);
    
        return view('books/index', [
            'books' => $sortedBooks,
            'category' => $category_slug,
            'search' => $search,
            'selectedLanguages' => $selectedLanguages,
            'selectedStock' => $selectedStock,
            'sort' => $sortType
        ]);
    }
    
    public function sort($query, $sortType) {
        $sort = explode('-', $sortType);
        $field = $sort[0]; 
        $order = $sort[1]; 

        if ($field === 'price') {
            $query->orderBy('price', $order);
        } elseif ($field === 'date') {
            $query->orderBy('created_at', $order);
        }

        $sortedBooks = $query->paginate(12);

        return $sortedBooks;
    }

    public function setSortType() {
        session(['sort' => request('sort')]);
    
        return redirect()->back();
    }

    public function indexCategory($category_slug) {
        $this->setCategory($category_slug);
        return $this->index($category_slug);
    }

    public function indexFilter() {
        return $this->index();
    }
    public function indexClear() {
        return $this->index('');
    }

    public function setCategory($category_slug) {
        session(['category' => $category_slug]);
        // return redirect()->back();
    }

    
    public function show($id) {
        $book = Book::findOrFail($id);
        $otherBooksInLanguage = Book::where('language', $book['language'])->where('id', '!=', $id)->take(12)->get();
        
        $ratings = ProductRating::where('book_id', $id)->get();
        $ratingAuthors = array();
        foreach ($ratings as $rating) {
            array_push($ratingAuthors, User::findOrFail($rating->user_id));
        }
        return view('books/show', [
            'book' => $book,
            'ratings' => $ratings,
            'ratingAuthors' => $ratingAuthors
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
            $imageName = str_replace(' ', '', request('author').Carbon::now()->toDateString().$image->getClientOriginalName());
            $request->file('mainImage')->storeAs('public', $imageName);
        }
        if (request('otherImages') != null) {
            $otherImageNames = array();
            foreach(request('otherImages') as $otherImage) {
                $otherImage->storeAs('public', str_replace(' ', '', request('author').Carbon::now()->toDateString().$image->getClientOriginalName()));
                array_push($otherImageNames, str_replace(' ', '', request('author').Carbon::now()->toDateString().$image->getClientOriginalName()));
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
