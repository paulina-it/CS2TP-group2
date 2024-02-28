<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\cart;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Book;
use App\Models\Guest;
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
        if (Count($basket) == 0) {
            return redirect('basket');
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
        return view('/order', [
            'books' => $books,
            'amounts' => $amounts,
        ]);
    }

    public function create(Request $request) {
        if (Auth::check()) {
            $user_id = Auth::id();
            $books = cart::where('user_id', $user_id)->get();
            $payment = Payment::where('credit_card_no', request('credit_card_no'))->get();
            if (count($payment) == 0) {
                $payment = new Payment;
                $payment->credit_card_no = request('credit_card_no');
                $payment->user_id = $user_id;
                $payment->save();
            }
        } else {
            $guest = new Guest;
            $guest->firstName = request('fName');
            $guest->lastName = request('lName');
            $guest->phone = request('phone');
            $guest->email = request('email');
            $guest->save();
            $books = $request->session()->get('books');
        }
        $order = new Order;
        $order->status = "pending";
        if (Auth::check()) {
            $order->user_id = $user_id;
        } else {
            $order->guest_id = $guest->id;
        }
        $order->save();
        $order_id = $order->id;
        foreach($books as $book) {
            if (Auth::check()) {
                $quantity = $book['quantity'];
                $book = $book['book_id'];
            } else {
                $quantity = (int)$request->session()->get('books')[0]['quantity'];
                $book = (int)$request->session()->get('books')[0]['book_id'];
            }
            $orderItem = new OrderItem;
            $orderItem->book_id = $book;
            $orderItem->order_id = $order_id;
            $orderItem->quantity = $quantity;
            $orderItem->save();
        }
        if (Auth::check()) {
            cart::where('user_id', $user_id)->delete();
        } else {
            $request->session()->put('books', []);
        }
        return redirect('basket')->with('success', 'Order Complete');
    }

    public function previous() {
        if (Auth::check()) {
            $user_id = Auth::id();
        }
        $orders = Order::where('user_id', $user_id)->get();
        
        $orderItems = array();
        $books = array();
        for ($i = 0; $i < count($orders); $i++) {
            array_push($orderItems, OrderItem::where('order_id', $orders[$i]['id'])->get());
            foreach($orderItems[$i] as $item) {
                array_push($books, [$i, Book::where('id', $item['book_id'])->get()]);
            }
        }
        return view('previousOrders', [
            'books' => $books,
            'orders' => $orders,
            'items' => $orderItems,
        ]);
    }

    public function return($id) {
        $order = Order::where('id', $id)->delete();
        return redirect(route('order.previous'));
    }
}
