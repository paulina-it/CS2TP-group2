<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\cart;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Coupon;
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
            return redirect('basket')->withErrors(['msg' => 'Please add items to basket']);
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
        $coupon = null;
        if ($request->session()->has('coupon')) {
            $coupon = $request->session()->get('coupon');
        }
        return view('/checkout', [
            'books' => $books,
            'amounts' => $amounts,
            'coupon' => $coupon
        ]);
    }

    public function create(Request $request) {
        BasketController::getQty();
        
        if (Auth::check()) {
            $validatedData = $request->validate([
                'credit_card_no' => [
                    'required',
                    'regex:/^(?:\d{4}[\s-]?\d{4}[\s-]?\d{4}[\s-]?\d{4}|\d{16})$/',
                ],
            ]);
            
            if (!$validatedData) {
                return redirect('order')->withErrors(['msg' => 'Please enter a valid credit card number']);
            }
            
            $user_id = Auth::id();
            $books = cart::where('user_id', $user_id)->get();
            $payment = Payment::where('credit_card_no', request('credit_card_no'))->get();
            if (count($payment) == 0) {
                // if (intval(request('credit_card_no')) > 2147483647) {
                //     return redirect('order')->withErrors(['msg' => 'Please enter a valid credit card number']);
                // }
                $payment = new Payment;
                $payment->credit_card_no = request('credit_card_no');
                $payment->user_id = $user_id;
                $payment->save();
            }
        } else {
            $validatedData = $request->validate([
                'fName' => ['required', 'string', 'max:255'],
                'lName' => ['required', 'string', 'max:255'],
                'phone' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^\+?(?:\d\s?){10,14}$/', 
                ],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'regex:/^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}(?:\.[a-zA-Z]{2,})?$/',
                ],
                'credit_card_no' => [
                    'required',
                    'string',
                    'regex:/^(?:\d{4}[\s-]?\d{4}[\s-]?\d{4}[\s-]?\d{4}|\d{16})$/',
                ]
            ], [
                'fName.required' => 'Please enter your first name.',
                'lName.required' => 'Please enter your last name.',
                'phone.required' => 'Please enter your phone number.',
                'phone.regex' => 'Please enter a valid UK phone number.',
                'email.required' => 'Please enter your email address.',
                'email.regex' => 'Please enter a valid email address.',
                'credit_card_no.required' => 'Please enter your credit card number.',
                'credit_card_no.regex' => 'Please enter a valid credit card number.',
            ]);
            
            if (!$validatedData) {
                return redirect('order')->withErrors(['msg' => 'Please enter valid information']);
            }
            
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
        if ($request->session()->get('coupon')) {
            $couponId = Coupon::where('coupon_name', $request->session()->get('coupon')['name'])->first();
            $order->coupon_id = $couponId['id'];
            $request->session()->forget('coupon');
        } else {
            $order->coupon_id = null;
        }
        $order->save();
        $order_id = $order->id;
        
        foreach ($books as $bookItem) {
            $bookId = $bookItem['book_id'];
            $quantity = $bookItem['quantity'];
            $inventoryBook = Book::find($bookId);
        
            if (!$inventoryBook) {
                continue;
            }

            if ($inventoryBook->quantity >= $quantity) {
                $inventoryBook->decrement('quantity', $quantity);
        
                $orderItem = new OrderItem;
                $orderItem->book_id = $bookId;
                $orderItem->order_id = $order_id;
                $orderItem->quantity = $quantity;
                $orderItem->save();
        
                if (Auth::check()) {
                    cart::where('book_id', $bookId)->delete();
                } else {
                    $request->session()->put('books', []);
                }
            } else {
                error_log('out of stock');
            }
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
        $coupons = array();
        for ($i = 0; $i < count($orders); $i++) {
            if ($orders[$i]['coupon_id']) {
                array_push($coupons, Coupon::where('id', $orders[$i]['coupon_id'])->first());
            }  else {
                array_push($coupons, null);
            }
            if (count(OrderItem::where('order_id', $orders[$i]['id'])->get()) != 0) {
                array_push($orderItems, OrderItem::where('order_id', $orders[$i]['id'])->get());
                foreach($orderItems[$i] as $item) {
                    for ($j = 0; $j < $item['quantity']; $j++) {
                        array_push($books, [$i, Book::where('id', $item['book_id'])->get()]);
                    }
                }
            } 
        }
        return view('previousOrders', [
            'books' => $books,
            'orders' => $orders,
            'items' => $orderItems,
            'coupons' => $coupons
        ]);
    }

    public function show($id) {
        if (Auth::check()) {
            $user_id = Auth::id();
        }
        $order = Order::where('id', $id)->get();
        $coupon = null;
        if ($order[0]['coupon_id']) {
            $coupon = Coupon::where('id', $order[0]['coupon_id'])->first();
        } 
        $books = array();
        $orderItems = OrderItem::where('order_id', $order[0]['id'])->get();
        foreach($orderItems as $item) {
            for ($j = 0; $j < $item['quantity']; $j++) {
                array_push($books, Book::where('id', $item['book_id'])->get());
            }
        }
        return view('previousOrdersShow', [
            'books' => $books,
            'order' => $order,
            'items' => $orderItems,
            'coupon' => $coupon
        ]);
    }

    public function return($id) {
        $orderItem = OrderItem::where('id', $id)->first();
        $order = Order::where('id', $orderItem['order_id'])->first();
        $bookId = $orderItem['book_id'];
        $orderItem->quantity--;
        // if ($orderItem['quantity'] > 1) {
        //     $order->status = 'partially refunded';
        // } else 
            $items = OrderItem::where('order_id', $order['id'])->get();
            if (count($items) > 1) {
            	// $orderItem->delete();
                $order->status = 'partially refunded';
            } else {
                $order->status = 'refunded';
            }
        
        $book = Book::where('id', $bookId)->first();
        $book->quantity++;

        $order->save();
        $orderItem->save();
        $book->save();
        
        return redirect(route('order.previous'));
    }
}
