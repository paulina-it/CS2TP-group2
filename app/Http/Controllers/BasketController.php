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
                $basket = [];
            }
        }
        $amounts = array();
        foreach ($basket as $elem) {
            $books->push(Book::where('id', $elem['book_id'])->get());
            array_push($amounts, $elem['quantity']);     
        }
        return view('/basket', [
            'books' => $books,
            'amounts' => $amounts,
        ]);
    }

    public function store($book_id, Request $request) {
        if (Auth::check()) {
            $product_qty = request('product-qty');
            if ($product_qty == null) {
                $product_qty = 1;
            }
            $user_id = Auth::id();
            $quantity = cart::where('book_id', $book_id)->where('user_id', $user_id)->get('quantity');
            if ($quantity != "[]") {
                $basket = cart::where('book_id', $book_id)->where('user_id', $user_id)->get();
                $basket[0]->quantity = $quantity[0]->quantity + $product_qty;
                $basket[0]->update();
            } else {
                $basket = new cart;
                $basket->user_id = $user_id;
                $basket->book_id = $book_id;
                $basket->quantity = $product_qty;
                $basket->save();
            }
        } else {
            if ($request->session()->has('books')) {
                $book_exists = false;
                $i = 0;
                $books = $request->session()->get('books');
                foreach ($books as $book) {
                    if ($book['book_id'] == $book_id) {
                        array_splice($books, $i, 1);
                        $book['quantity'] += $product_qty;
                        $book_exists = true;
                        array_push($books, $book);
                        $request->session()->put('books', $books);
                    }
                    $i++;
                }
                if (!$book_exists) {
                    $request->session()->push('books', ["book_id" => $book_id, "quantity" => $product_qty]);
                }
                
            } else {
                $request->session()->put('books', [["book_id" => $book_id, "quantity" => $product_qty]]);
            }
        }

        return redirect('basket');
    }
    public function destroy($book_id, Request $request) {
        if (Auth::check()){
            $user_id = Auth::id();
            $item = cart::where('book_id', $book_id)->where('user_id', $user_id)->delete();;
        } else {
            $i = 0;
            $books = $request->session()->get('books');
            foreach ($books as $book) {
                if ($book['book_id'] == $book_id) {
                    array_splice($books, $i, 1);
                    $request->session()->put('books', $books);
                }
                $i++;
            }
        }
        return redirect('basket');
    }
}

