<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\cart;
use App\Models\Book;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function index(Request $request) {
        $books = collect();
        if (Auth::check()) {
            $user_id = Auth::id();
            $basket = cart::where('user_id', $user_id)->get();
            
        } else {
            if ($request->session()->has('books')) {
                $basket = $request->session()->get('books');
            } else {
                $basket = collect();
            }
        }
        $amounts = array();

        foreach ($basket as $elem) {
            if (Auth::check()) {
                $books->push(Book::where('id', $elem['book_id'])->get());
            } else {
                $books->push(Book::where('id', $elem)->get());
            }
            array_push($amounts, $elem['quantity']);     
        }
        return view('/basket', [
            'books' => $books,
            'amounts' => $amounts,
        ]);
    }

    public function store($book_id, Request $request) {
        if (Auth::check()) {
            $user_id = Auth::id();
            $quantity = cart::where('book_id', $book_id)->where('user_id', $user_id)->get('quantity');
            if ($quantity != "[]") {
                $basket = cart::where('book_id', $book_id)->where('user_id', $user_id)->get();
                $basket[0]->quantity = $quantity[0]->quantity + request('product-qty');
                $basket[0]->update();
            } else {
                $basket = new cart;
                $basket->user_id = $user_id;
                $basket->book_id = $book_id;
                $basket->quantity = request('product-qty');
                $basket->save();
            }
        } else {
            if ($request->session()->has('books')) {
                $request->session()->push('books', $book_id);
            } else {
                $request->session()->put('books', collect());
            }
        }

        return redirect('basket');
    }
    public function destroy($book_id, Request $request) {
        if (Auth::check()){
            $user_id = Auth::id();
            $item = cart::where('book_id', $book_id)->where('user_id', $user_id)->delete();;
        } else {
            $basket = $request->session()->get('books');
            $key = $basket->search($book_id);
            $basket->forget($key);
            $request->session()->put('books', $basket);
        }
        return redirect('basket');
    }
}

