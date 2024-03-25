<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Guest;
use App\Models\Order;
use App\Models\CustomerQuery;
use App\Models\OrderItem;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;

class AdminController extends Controller
{
    public function books() {
        $search = request('search');
        $sort = request('sort') ?? 'created_at';
        $order = request('order') ?? 'desc';
    
        $query = Book::query();
    
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('book_name', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('genre', 'like', '%' . $search . '%')
                    ->orWhere('language', 'like', '%' . $search . '%');
            });
        }
    
        if (!empty($sort)) {
            if ($order == 'desc') {
                $query->orderByDesc($sort);
            } else {
                $query->orderBy($sort);
            }
        }
    
        $books = $query->paginate(10);
    
        $books->appends(['sort' => $sort, 'order' => $order]);

        return view('admin.admin-books', [
            'books' => $books,
            'search' => $search,
            'sort' => $sort,
            'order' => $order,
            'category' => null
        ]);
    }
    

    public function orders() {
        $query = Order::query();
    
        if (request()->filled('idSearch')) {
            $query->where('id', request('idSearch'));
        }
    
        $filter = request('filter') ?? null;
        if ($filter && $filter !== 'none') {
            $query->where('status', $filter);
        }
    
        $sortField = request('sort') ?? 'created_at';
        $sortOrder = request('order') ?? 'desc'; 
    
        $orders = $query->orderBy($sortField, $sortOrder)->paginate(20);;
    
        $users = [];
        foreach ($orders as $order) {
            $user = User::where('id', $order['user_id'])->first();
            if (!$user) {
                $user = Guest::where('id', $order['guest_id'])->first();
            }
            $users[] = $user ? $user : (object)[
                'id' => null,
                'firstName' => null,
                'lastName' => null,
                'phone' => null,
                'email' => null,
            ];
        }

        $orders->appends([
            'idSearch' => request('idSearch'),
            'filter' => $filter,
            'sort' => $sortField,
            'order' => $sortOrder
        ]);
    
        return view('admin.admin-orders', [
            'orders' => $orders,
            'users' => $users,
            'filter' => $filter,
            'sort' => $sortField,
            'order' => $sortOrder
        ]);
    }
    

    public function process($id) {
        $order = Order::findOrFail($id);
        if (request("status") == "processed" && $order->status == 'pending') {
            $orderItems = OrderItem::where('order_id', $id)->get();
            foreach ($orderItems as $item) {
                $item->save();
            }
        }
        else if ((request("status") == "cancelled" || request("status") == "refunded") && ($order->status == 'processed' || request("status") == "shipped")) {
            $orderItems = OrderItem::where('order_id', $id)->get();
            foreach ($orderItems as $item) {
                $book = Book::where('id', $item['book_id'])->first();
                $book->quantity += $item['quantity'];
                $book->save();
                $item->save();
            }
        }
        $order->status = request("status");
        $order->save();
        return redirect('admin/orders');
    }

    public function order($id) {
        $order = Order::findOrFail($id);
        $books = array();
        $orderItems = OrderItem::where('order_id', $id)->get();
        foreach($orderItems as $item) {
            $book = Book::find($item->book_id);
            
            for ($j = 0; $j < $item->quantity; $j++) {
                $books[] = [
                    'book' => $book
                ];
            }
        }
        if ($order['user_id']) {
            $user = User::where('id', $order['user_id'])->first();
        } else if ($order['guest_id']) {
            $user = Guest::where('id', $order['guest_id'])->first();
        } else {
            $user = ["id" => null,
            "firstName" => null,
            "lastName" => null,
            "phone" => null,
            "email" => null];
        }
        return view('admin/admin-order-details', [
            'order' => $order,
            'user' => $user,
            'books' => $books
        ]);

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
        $booksSold[] = OrderItem::whereDate('order_item.created_at', $date)
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
    $query = CustomerQuery::query();

    $sortField = request('sort') ?? 'created_at';
    $sortOrder = request('order') ?? 'desc';
    $sortableFields = ['id', 'first_name', 'last_name', 'email', 'type', 'status', 'created_at'];

    if (in_array($sortField, $sortableFields)) {
        $query->orderBy($sortField, $sortOrder);
    }

    $queries = $query->paginate(20);

    return view('admin.queries', [
        'queries' => $queries,
        'sort' => $sortField,
        'order' => $sortOrder
    ]);
}


    public function queriesStatus($id) {
        $querie = CustomerQuery::findOrFail($id);
        $querie->status = request('status');
        $querie->save();
        return redirect('admin/queries');
    }

    public function users() {
        $query = User::query();
    
        $filter = request('filter');
        if ($filter && in_array($filter, ['admin', 'user'])) {
            $query->where('role', $filter);
        }
    
        $idSearch = request('idSearch');
        if ($idSearch) {
            $query->where('id', $idSearch)
            ->orWhere('firstName', $idSearch)
            ->orWhere('lastName', $idSearch)
            ->orWhere('email', $idSearch);
        }
    
        $sortField = request('sort') ?? 'created_at';
        $sortOrder = request('order') ?? 'desc';
        $sortableFields = ['first_name', 'last_name', 'email', 'created_at', 'role'];
    
        if (in_array($sortField, $sortableFields)) {
            $query->orderBy($sortField, $sortOrder);
        }
    
        $users = $query->paginate(20);
    
        return view('admin.admin-users', [
            'users' => $users,
            'filter' => $filter,
            'idSearch' => $idSearch,
            'sort' => $sortField,
            'order' => $sortOrder
        ]);
    }
    

    public function userDestroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
    
        return redirect()->route('admin-users')->with('success', 'User deleted successfully.');
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

    public function report() {
        $books = Book::all();
        $orderedItems = OrderItem::all();
        $orderCounts = [];
        $orders = Order::all();

        foreach ($orderedItems as $item) {
            $bookId = $item->book_id;
            if (isset($orderCounts[$bookId])) {
                $orderCounts[$bookId]++;
            } else {
                $orderCounts[$bookId] = 1;
            }
        }

        foreach ($books as $book) {
            $bookId = $book->id;
            if (isset($orderCounts[$bookId])) {
                $book->orders_count = $orderCounts[$bookId];
            } else {
                $book->orders_count = 0;
            }
        }

        foreach ($orders as $order) {
            $user = User::find($order['user_id']) ?? Guest::find($order['guest_id']);
            $order->user = $user['firstName'].' '.$user['lastName'];
        }

        return view('admin/report',[
            'books' => $books,
            'orders' => $orders,
        ]);
    }

    public function saveReportPdf() {
        $view = $this->report(); 
    
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
    
        $html = $view->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'report_' . Carbon::now()->format('Y-m-d') . '.pdf';
    
        return $dompdf->stream($filename);
    }
}
