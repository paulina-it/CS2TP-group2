<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\cart;
use App\Models\Order;
use App\Models\Book;
use App\Models\Payment;

class OrderController extends Controller
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
        //$amounts = array();

        foreach ($basket as $elem) {
            if (Auth::check()) {
                $books->push(Book::where('id', $elem['book_id'])->get());
            } else {
                $books->push(Book::where('id', $elem)->get());
            }
            //array_push($amounts, $elem['Amount']);     
        }
        return view('/order', [
            'books' => $books,
            //'amounts' => $amounts,
        ]);
    }

    public function create(Request $request) {
        if (Auth::check()) {
            $user_id = Auth::id();
            $books = cart::where('user_id', $user_id)->get('book_id');
            $payment = Payment::where('credit_card_no', request('credit_card_no'))->get();
            if (count($payment) == 0) {
                $payment = new Payment;
                $payment->credit_card_no = request('credit_card_no');
                $payment->user_id = $user_id;
                $payment->save();
            }
        } else {
            $books = $request->session()->get('books');
        }
        
        
        //$order_status = new Order_Status;
        
        foreach($books as $book) {
            if (Auth::check()) {
                $book = $book['book_id'];
            }
            $order = new Order;
            $order->book_id = $book;
            $order->save();
        }
        if (Auth::check()) {
            cart::where('user_id', $user_id)->delete();
        } else {
            $request->session()->put('books', collect());
        }
        return redirect('basket')->with('success', 'Order Complete');
    }
}
