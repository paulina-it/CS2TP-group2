<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\wish;
use App\Models\wishlist;
use App\Models\Book;
use App\Models\Price;
use App\Models\cart;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index() {
        $books = collect();
        if (Auth::check()) {
            $user_id = Auth::id();
            $wishlist = wishlist::where('user_id', $user_id)->get();
            if (count($wishlist) != 0) {
                $wish = wish::where('wishlist_id', $wishlist[0]['id'])->get();
                foreach ($wish as $elem) {
                    $books->push(Book::where('id', $elem['book_id'])->get());  
                }
            }
        }
        return view('/wishlist', [
            'books' => $books,
        ]);
    }

    public function store($book_id) {
        if (Auth::check()) {
            $user_id = Auth::id();
            $list = wishList::where('user_id', $user_id)->get();
            if (count($list) == 0) {
                $list = new wishlist;
                $list->user_id = $user_id;
                $list->save();
            }
            $currentWish = wish::where('book_id', $book_id)->where('wishlist_id', $list[0]['id'])->get();
            if (count($currentWish) == 0) {
                $wish = new wish;
                $wish->book_id = $book_id;
                $wish->wishlist_id = $list[0]['id'];
                $wish->save();
            }
        }

        return redirect('wishlist');
    }

    public function basket($book_id) {
        if (Auth::check()) {
            $user_id = Auth::id();
            $list = wishlist::where('user_id', $user_id)->get();
            $wish = wish::where('book_id', $book_id)->where('wishlist_id', $list[0]['id'])->delete();

            $product_qty = 1;
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
        }
        return redirect('basket');
    }

    public function destroy($book_id) {
        if (Auth::check()){
            $user_id = Auth::id();
            $list = wishlist::where('user_id', $user_id)->get();
            $wish = wish::where('book_id', $book_id)->where('wishlist_id', $list[0]['id'])->delete();
        }
        return redirect('wishlist');
    }
}