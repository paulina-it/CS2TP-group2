<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Guest;
use App\Models\Order;
use App\Models\CustomerQuery;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function dashboard() {
        // $outOfStock = Book::where('quantity', '<=', 0)->get()->count();
        // $queriesPending = CustomerQuery::where('status', '=', 'not reviewed')->get()->count();
        // $orders = Order::where('status', '=', 'pending')->get()->count();
        // return view('admin/admin-dashboard', [
        //     'outOfStock' => $outOfStock,
        //     'queries' => $queries,
        //     'orders' => $orders,
        // ]);
    $dates = [];
    $queries = [];
    $outOfStock = [];
    $orders = [];
    $booksSold = [];

    $endDate = Carbon::now();

    $startDate = Carbon::now()->subDays(7);

    while ($startDate <= $endDate) {
        $dates[] = $startDate->format('Y-m-d');
        $startDate->addDay();
    }

    foreach ($dates as $date) {
        $queries[] = CustomerQuery::whereDate('created_at', $date)->count();
        $queriesPending = CustomerQuery::where('status', '=', 'not reviewed')->get()->count();
        $outOfStock = Book::where('quantity', '<=', 0)->get()->count();
        $orders[] = Order::whereDate('created_at', $date)->count();
        $ordersPending = Order::where('status', '=', 'pending')->get()->count();
        $booksSold[] = DB::table('order_item')
        ->join('orders', 'order_item.id', '=', 'orders.id')
        ->whereDate('orders.created_at', $date)
        ->sum('order_item.quantity');
    }

    return view('admin/admin-dashboard', [
        'dates' => $dates,
        'queries' => $queries,
        'queriesPending' => $queriesPending,
        'outOfStock' => $outOfStock,
        'orders' => $orders,
        'ordersPending' => $ordersPending,
        'booksSold' => $booksSold,
    ]);    
}

    public function queries() {
        $queries = CustomerQuery::all();
        return view('admin/queries', [
            'queries'=> $queries,
        ]);
    }

    public function queriesStatus($id) {
        $querie = CustomerQuery::findOrFail($id);
        $querie->status = request('status');
        $querie->save();
        return redirect('admin/queries');
    }

    public function users() {
        $users = User::all();
        return view('admin/admin-users',[
            'users' => $users,
        ]);
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return view('admin/admin-users-edit',[
            'user' => $user,
        ]);
    }

    public function save($id) {
        $user = User::findOrFail($id);
        $user->firstName = request('firstName');
        $user->lastName = request('lastName');
        $user->email = request('email');
        $user->phone = request('phone');
        $user->role = request('role');
        $user->save();
        return redirect('admin/users');
    }
}
