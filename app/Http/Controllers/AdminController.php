<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\CustomerQuery;

class AdminController extends Controller
{
    public function books() {
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
        return view('admin/admin-books', [
            'books' => $books,
            'search' => $search,
            'category' => null
        ]);
    }

    public function dashboard() {
        $outOfStock = Book::where('quantity', '<=', 0)->get()->count();
        $queries = CustomerQuery::where('status', '=', 'not reviewed')->get()->count();
        return view('admin/admin-dashboard', [
            'outOfStock' => $outOfStock,
            'queries' => $queries,
        ]);
    }
}
