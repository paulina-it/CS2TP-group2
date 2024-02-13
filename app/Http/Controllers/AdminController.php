<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Guest;
use App\Models\Order;

class AdminController extends Controller
{
    public function books() {
        $search = request('search');
        if (empty($search)) {
            $books = Book::all();
        } else {
            $books = Book::where(function ($query) use($search) {
                $query->where('book_name', 'like', '%' . $search . '%')
                ->orWhere('author', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('genre', 'like', '%' . $search . '%')
                ->orWhere('language', 'like', '%' . $search . '%');
            })->get();
        }
        return view('admin/admin-books', [
            'books' => $books,
            'search' => $search,
            'category' => null
        ]);
    }

    public function orders() {
        if (request('idSearch')) {
            $orders = Order::where('user_id', request('idSearch'))->orWhere('guest_id', request('idSearch'))->get();
        } else {
            $orders = Order::all();
        } 
        if (request('filter') && request('filter') != "none") {
            $orders = $orders->filter(function($item)
                {
                    if($item['status'] == request('filter'))
                    {
                        return $item;
                    }
            });
        }
        $orders = $orders->values();
        $users = array();
        foreach ($orders as $order) {
            if ($order['user_id']) {
                array_push($users, User::where('id', $order['user_id'])->get());
            } else if ($order['guest_id']) {
                array_push($users, Guest::where('id', $order['guest_id'])->get());
            } else {
                array_push($users, [["id" => null,
                "firstName" => null,
                "lastName" => null,
                "phone" => null,
                "email" => null,]]);
            }
        }
        return view('admin/admin-orders', [
            'orders' => $orders,
            'users' => $users,
        ]);
    }

    public function process($id) {
        $order = Order::findOrFail($id);
        $order->status = request("status");
        $order->save();
        return redirect('admin/orders');
    }
}
