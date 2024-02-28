<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index() {
        $date = Carbon::now()->subMonth();
            $books = Book::where(function ($query) use($date) {
                $query->whereDate('created_at', '>', $date->toDateString());
            })->take(12)->get();
        
        return view('index', [
            'books' => $books->reverse(),
            'ratings' => $ratings
        ]);
    }
}
