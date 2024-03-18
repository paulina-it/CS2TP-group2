<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\cart;
use App\Models\Book;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\wishlist;
use App\Models\wish;

class BasketController extends Controller
{
    public function index(Request $request) {
        $this->getQty();
        $books = collect();
        $maxQtyArr = collect();
        $recs = collect();
        $wishes = collect();
        
        if (Auth::check()) {
            $user_id = Auth::id();
            $basket = cart::where('user_id', $user_id)->get();
            $wishlist = wishlist::where('user_id', $user_id)->get();
            if (count($wishlist) != 0) {
                        $wish = Wish::where('wishlist_id', $wishlist[0]['id'])->get();
                        foreach ($wish as $wishElem) {
                            $book = Book::where('id', $wishElem['book_id'])->where('quantity', '>', 0)->get();
                            if ($book->isNotEmpty()) {
                                $wishes->push($book);
                            }
                    }
            }            
        } else {
            if ($request->session()->has('books')) {
                $basket = $request->session()->get('books');
            } else {
                $basket = [];
            }
        }
        $basket = collect($basket);

        if ($basket ) {
            $basketBookIds = $basket->pluck('book_id')->toArray();
        }
        foreach ($basket as $elem) {
            $book = Book::find($elem['book_id']);
            if ($book) {
                $book->amount = $elem['quantity'];
                $books->push($book);
            }
        }
        
        if (Auth::check()) {
            $recs = Book::whereNotIn('id', $basketBookIds)
                        ->where('quantity', '>', 0)
                        ->whereIn('language', $books->pluck('language')->unique())
                        ->take(12) 
                        ->get();
            $recs = $recs->flatten()->unique();
        }

        if ($recs->isEmpty()) {
            $recs = Book::oldest()->where('quantity', '>', 0)->take(10)->get();
        }
        
        return view('/basket', [
            'books' => $books,
            'maxQty' => $maxQtyArr,
            'recommended' => $recs,
            'wishlist' => $wishes
        ]);
    }

    public function store($book_id, Request $request) {
        $product_qty = request('product-qty');
        if ($product_qty == null) {
            $product_qty = 1;
        }
        if (Auth::check()) {
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

    public function update($id, Request $request) {
        if (Auth::check()) {
            $user_id = Auth::id();
            $basket = cart::where('book_id', $id)->where('user_id', $user_id)->get();
            $basket = $basket[0];
            $basket->quantity = request('product-qty');
            $basket->save();
            error_log($basket->quantity);
        } else {
            $books = $request->session()->get('books');
            $i = 0;
            foreach ($books as $book) {
                if ($book['book_id'] == $id) {
                    array_splice($books, $i, 1);
                    $book['quantity'] = request('product-qty');
                    array_push($books, $book);
                    $request->session()->put('books', $books);
                }
                $i++;
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

    public static function getQty() {
        $qty = 0;
        
        if (Auth::check()) {
            $user_id = Auth::id();
            $basket = Cart::where('user_id', $user_id)->get();
        } elseif (session()->has('books')) {
            $basket = session()->get('books');
        } else {
            $basket = [];
        }
    
        foreach ($basket as $item) {
            if (Book::find($item['book_id'])->quantity > 0) {
                $qty += $item['quantity'];     
            }
        }

        Session::put('basket_qty', $qty);
    
        return $qty;
    }
    
}
