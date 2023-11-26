<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\cart;
use App\Models\cart_item;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function index() {
        $user_id = Auth::id();
        $basket_id = cart::where('user_id', $user_id)->get('cart_id');
        $basket_items = cart_item::where('cart_id', $basket_id)->get();
        $books = collect();
        foreach ($basket_items as $book) {
            $books->push(Book::where('id', $book['book_id'])->get());    
        }
        return view('/basket', ['books' => $books]);
    }
}
