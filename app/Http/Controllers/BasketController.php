<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\cart;
use App\Models\cart_item;
use App\Models\Book;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function index() {
        $user_id = Auth::id();
        $basket_id = cart::where('user_id', $user_id)->get('cart_id');
        $basket_items = cart_item::where('cart_id', $basket_id[0]['cart_id'])->get();
        $books = collect();
        $prices = array();
        foreach ($basket_items as $book) {
            $books->push(Book::where('id', $book['book_id'])->get());  
            $price = Price::where('book_id', $book['book_id'])->get('hardcover');
            array_push($prices, $price[0]['hardcover']);  
        }
        return view('/basket', ['books' => $books, 'prices' => $prices]);
    }

    public function store($book_id) {
        $user_id = Auth::id();
        $basket_id = cart::where('user_id', $user_id)->get('cart_id');
        $basket_id = $basket_id[0]['cart_id'];

        $cart_item = new cart_item;
        $cart_item->cart_id = $basket_id;
        $cart_item->book_id = $book_id;

        $cart_item->save();
        return redirect('basket');
    }
    public function destroy($book_id) {
        $user_id = Auth::id();
        $basket_id = cart::where('user_id', $user_id)->get('cart_id');
        $basket_id = $basket_id[0]['cart_id'];
        $item = cart_item::where('book_id', $book_id)->where('cart_id', $basket_id)->delete();;
        return redirect('basket');
    }
}
