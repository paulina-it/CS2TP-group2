<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index() {
        BasketController::getQty();
        $books = Book::latest()->take(10)->get();
        $books = collect($books)->shuffle();
        return view('index', [
            'books' => $books
        ]);
    }
}
