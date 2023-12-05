<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\cart;
use App\Models\Order;
use App\Models\Book;

class OrderController extends Controller
{
    public function index() {
        $user_id = Auth::id();
        $basket = cart::where('user_id', $user_id)->get();
        $books = collect();
        //$amounts = array();
        foreach ($basket as $elem) {
            $books->push(Book::where('id', $elem['book_id'])->get());
            //array_push($amounts, $elem['Amount']);     
        }
        return view('order', [
            'books' => $books
            //'amounts' => $amounts,
        ]);
    }

    public function create() {
        $user_id = Auth::id();
        $books = cart::where('user_id', $user_id)->get('book_id');
        foreach($books as $book) {
            $book = $book['book_id'];
            $order = new Order;
            $order->book_id = $book;
            $order->save();
        }
        cart::where('user_id', $user_id)->delete();
        return redirect('basket')->with('success', 'Order Complete');
    }
}
